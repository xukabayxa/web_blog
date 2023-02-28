<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Model\Admin\Block2 as ThisModel;
use Illuminate\Support\Facades\Route;
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

class Block2Controller extends Controller
{
    protected $view = 'admin.blocks2';
    protected $route = 'Block2';

    public function index($page)
    {
        return view($this->view . '.index', compact('page'));
    }

    // Hàm lấy data cho bảng list
    public function searchData(Request $request)
    {dd(2);
        $objects = ThisModel::searchByFilter($request);
        return Datatables::of($objects)
            ->editColumn('name', function ($object) {
                return $object->name;
            })
            ->editColumn('created_by', function ($object) {
                return $object->user_create->name ? $object->user_create->name : '';
            })
            ->editColumn('created_at', function ($object) {
                return \Carbon\Carbon::parse($object->created_at)->format('H:m d/m/Y');
            })
            ->addColumn('action', function ($object) {
                $result = '';
                if ($object->canEdit()) {
                    $result .= '<a href="' . route($this->route . '.edit', $object->id) . '" title="Sửa" class="btn btn-sm btn-primary edit"><i class="fas fa-pencil-alt"></i></a> ';
                }
                if ($object->canDelete()) {
                    $result .= '<a href="' . route($this->route . '.delete', $object->id) . '" title="Xóa" class="btn btn-sm btn-danger confirm"><i class="fas fa-times"></i></a>';
                }
                return $result;
            })
            ->addIndexColumn()
            ->rawColumns(['name', 'action'])
            ->make(true);
    }

    public function create()
    {
        if (strpos(url()->current(), 'about1')) {
            $page = 'about1';
        } elseif (strpos(url()->current(), 'about2')) {
            $page = 'about2';
        } elseif (strpos(url()->current(), 'about3')) {
            $page = 'about3';
        } elseif (strpos(url()->current(), 'about4')) {
            $page = 'about4';
        }

        return view($this->view . '.create', compact('page'));
    }

    public function store(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'name' => 'required|max:255',
                'title' => 'nullable',
                'body' => 'nullable',
                'image' => 'nullable|file|mimes:jpg,jpeg,png|max:3000'

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
            $object->title = $request->title;
            $object->body = $request->body;
            $object->page = $request->page;

            $object->save();


            if ($request->image) {
                FileHelper::uploadFile($request->image, 'blocks2', $object->id, ThisModel::class, 'image');
            }

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

    public function edit($id)
    {
        $object = ThisModel::getDataForEdit($id);
        return view($this->view . '.edit', compact('object'));
    }

    public function update(Request $request, $id)
    {

        $validate = Validator::make(
            $request->all(),
            [
                'name' => 'required|max:255',
                'body' => 'required',
                'image' => 'nullable|file|mimes:jpg,jpeg,png|max:3000'

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
            $object = ThisModel::find($id);

            $object->name = $request->name;
            $object->body = $request->body;

            $object->save();

            if ($request->image) {
                if ($object->image->id) {
                    FileHelper::forceDeleteFiles($object->image->id, $object->id, ThisModel::class, 'image');
                }
                FileHelper::uploadFile($request->image, 'blocks', $object->id, ThisModel::class, 'image');
            }

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

        return redirect()->route($this->route . '.index')->with($message);
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
    public function exportPDF(Request $request)
    {
        $data = ThisModel::searchByFilter($request);
        $pdf = PDF::loadView($this->view . '.pdf', compact('data'));
        return $pdf->download('danh_sach_lich_hen.pdf');
    }
}
