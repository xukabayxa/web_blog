<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\FileHelper;
use App\Model\Admin\PartnerCategory;
use Illuminate\Http\Request;
use App\Model\Admin\Partner as ThisModel;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use \stdClass;

use Rap2hpoutre\FastExcel\FastExcel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PartnerController extends Controller
{
    protected $view = 'admin.partners';
    protected $route = 'partners';

    public function index()
    {
        $cates = PartnerCategory::query()->get();

        return view($this->view.'.index', compact('cates'));
    }

    // Hàm lấy data cho bảng list
    public function searchData(Request $request)
    {
        $objects = ThisModel::searchByFilter($request);
        return Datatables::of($objects)
            ->editColumn('updated_by', function ($object) {
                return $object->user_update->name ?: '';
            })
            ->editColumn('created_by', function ($object) {
                return $object->user_update->name ?: '';
            })
            ->editColumn('updated_at', function ($object) {
                return formatDate($object->updated_at);
            })
            ->editColumn('is_show', function ($object) {
                if($object->is_show == 1) {
                    return 'Hiển thị';
                }
                return 'Không hiển thị';
            })
            ->addColumn('image', function ($object) {
                return '<img class="thumbnail img-preview" src="'.($object->image ? $object->image->path : '').'">';
            })

            ->addColumn('action', function ($object) {
                $result = '';
                $result .= '<a href="javascript:void(0)" title="Sửa" class="btn btn-sm btn-primary edit"><i class="fas fa-pencil-alt"></i></a> ';
                $result .= '<a href="' . route($this->route.'.delete', $object->id) . '" title="Xóa" class="btn btn-sm btn-danger confirm"><i class="fas fa-times"></i></a>';
                return $result;
            })
            ->addIndexColumn()
            ->rawColumns(['image','name','action'])
            ->make(true);
    }

    public function create()
    {
        $cates = PartnerCategory::query()->get();

        return view($this->view.'.create', compact('cates'));
    }

    public function store(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'name' => 'required|max:255',
                'code' => 'required|max:255|unique:origins,code',
                'is_show' => 'required',
                'cate_ids' => 'required|array',
                'image' => 'nullable|file|mimes:jpg,jpeg,png|max:3000',

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
            $object->code = $request->code;
            $object->is_show = $request->is_show;
            $object->created_by = auth()->id();
            $object->save();

            if($request->image) {
                FileHelper::uploadFile($request->image, 'partners', $object->id, \App\Model\Admin\Partner::class, 'image',8);
            }

            $object->categories()->syncWithoutDetaching($request->cate_ids);

            DB::commit();
            $json->success = true;
            $json->message = "Thao tác thành công!";
            $json->data = $object;
            return Response::json($json);
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage());
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
                'code' => 'required|unique:origins,code,' . $id,
                'is_show' => 'required',
                'cate_ids' => 'required|array',
                'image' => 'nullable|file|mimes:jpg,jpeg,png|max:3000',

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
            $object->code = $request->code;
            $object->name = $request->name;
            $object->is_show = $request->is_show;

            $object->save();

            if($request->image) {
                if($object->image) {
                    FileHelper::forceDeleteFiles($object->image->id, $object->id, \App\Model\Admin\Partner::class, 'image');
                }
                FileHelper::uploadFile($request->image, 'manufacturers', $object->id, ThisModel::class, 'image',8);
            }

            $object->categories()->syncWithoutDetaching($request->cate_ids);

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
        $pdf = \Barryvdh\DomPDF\PDF::loadView($this->view.'.pdf', compact('data'));
        return $pdf->download('danh_sach_lich_hen.pdf');
    }
}
