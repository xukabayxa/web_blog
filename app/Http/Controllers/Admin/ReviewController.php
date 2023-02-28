<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Model\Admin\Review as ThisModel;
use Yajra\DataTables\DataTables;
use Validator;
use \stdClass;
use Response;
use Rap2hpoutre\FastExcel\FastExcel;
use PDF;
use App\Http\Controllers\Controller;
use \Carbon\Carbon;
use Illuminate\Validation\Rule;
use App\Helpers\FileHelper;
use DB;
use Auth;
use App\Model\Common\Customer;

class ReviewController extends Controller
{
	protected $view = 'admin.reviews';
	protected $route = 'Review';

	public function index()
	{
		return view($this->view.'.index');
	}
	// Hàm lấy data cho bảng list
    public function searchData(Request $request)
    {
		$objects = ThisModel::searchByFilter($request);
        return Datatables::of($objects)
			->editColumn('name', function ($object) {
				return $object->name;
			})
			->addColumn('message', function ($object) {
				return $object->message;
			})
			->editColumn('updated_by', function ($object) {
				return $object->user_update->name ? $object->user_update->name : '';
			})
			->editColumn('updated_at', function ($object) {
				return formatDate($object->updated_at);
			})

			->addColumn('action', function ($object) {
				$result = '';
				$result .= '<a href="javascript:void(0)" title="Sửa" class="btn btn-sm btn-primary edit"><i class="fas fa-pencil-alt"></i></a> ';
				$result .= '<a href="' . route($this->route.'.delete', $object->id) . '" title="Xóa" class="btn btn-sm btn-danger confirm"><i class="fas fa-times"></i></a>';
				return $result;
			})
			->addIndexColumn()
			->rawColumns(['name','action'])
			->make(true);
    }

	public function create()
	{
		return view($this->view.'.create');
	}

	public function store(Request $request)
	{
		$validate = Validator::make(
			$request->all(),
			[
				'name' => 'required|max:255',
				'message' => 'required|max:255',
			]
		);
		$json = new stdClass();

		if ($validate->fails()) {
			$json->success = false;
            $json->errors = $validate->errors();
            $json->message = "Thao tác thất bại!";
            return Response::json($json);
		}

		DB::beginTransaction();
		try {
			$object = new ThisModel();

			$object->name = $request->name;
			$object->message = $request->message;
			$object->save();

			DB::commit();
			$json->success = true;
			$json->message = "Thao tác thành công!";
			$json->data = $object;
			return Response::json($json);
		} catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
	}

	public function show(Request $request,$id)
	{
		$object = ThisModel::findOrFail($id);
		if (!$object->canview()) return view('not_found');
		$object = ThisModel::getDataForShow($id);
		return view($this->view.'.show', compact('object'));
	}

	public function update(Request $request, $id)
	{

		$validate = Validator::make(
			$request->all(),
			[
				'name' => 'required|max:255',
				'message' => 'required|max:255',
			]
		);
		$json = new stdClass();

		if ($validate->fails()) {
			$json->success = false;
            $json->errors = $validate->errors();
            $json->message = "Thao tác thất bại!";
            return Response::json($json);
		}

		DB::beginTransaction();
		try {
			$object = ThisModel::findOrFail($id);
			$object->name = $request->name;
			$object->message = $request->message;

			$object->save();

			DB::commit();
			$json->success = true;
			$json->message = "Thao tác thành công!";
			$json->data = $object;
			return Response::json($json);
		} catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
	}

	public function delete($id)
    {
		$object = ThisModel::findOrFail($id);
		if (!$object->canDelete()) {
			$message = array(
				"message" => "Không thể xóa!",
				"alert-type" => "warning"
			);
		} else {
			$object->delete();
			$message = array(
				"message" => "Thao tác thành công!",
				"alert-type" => "success"
			);
		}


        return redirect()->route($this->route.'.index')->with($message);
	}

	public function getDataForEdit($id) {
        $json = new stdclass();
        $json->success = true;
        $json->data = ThisModel::getDataForEdit($id);
        return Response::json($json);
	}

		// Xuất Excel
		public function exportExcel(Request $request)
		{
			return (new FastExcel(ThisModel::searchByFilter($request)))->download('danh_sach_lich_hen.xlsx', function ($object) {
				return [
					'Khách hàng' => $object->customer->name,
					'SĐT khách' => $object->customer->mobile,
					'Giờ hẹn' => \Carbon\Carbon::parse($object->booking_time)->format('H:m d/m/Y'),
					'Ghi chú' => $object->note,
					'Trạng thái' => $object->status == 0 ? 'Khóa' : 'Hoạt động',
				];
			});
		}

		// Xuất PDF
		public function exportPDF(Request $request) {
			$data = ThisModel::searchByFilter($request);
			$pdf = PDF::loadView($this->view.'.pdf', compact('data'));
			return $pdf->download('danh_sach_lich_hen.pdf');
		}
}
