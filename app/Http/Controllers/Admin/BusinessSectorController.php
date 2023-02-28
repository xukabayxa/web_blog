<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Business\BusinessStoreRequest;
use App\Http\Requests\Business\BusinessUpdateRequest;
use App\Http\Requests\Project\ProjectStoreRequest;
use App\Model\Admin\BusinessSector;
use App\Model\Admin\BusinessSectorLanguage;
use Google\Service\MyBusinessLodging\Business;
use Illuminate\Http\Request;
use App\Model\Admin\BusinessSector as ThisModel;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\DataTables;
use Validator;
use Auth;
use \stdClass;
use Response;
use Rap2hpoutre\FastExcel\FastExcel;
use PDF;
use App\Http\Controllers\Controller;
use \Carbon\Carbon;
use DB;
use App\Http\Traits\ResponseTrait;
use App\Helpers\FileHelper;
use App\Model\Common\User;

class BusinessSectorController extends Controller
{
    use ResponseTrait;

    protected $view = 'admin.business';
    protected $route = 'business';

    public function index()
    {
        return view($this->view.'.index');
    }

    // Hàm phân trang, search cho datatable
    public function searchData(Request $request)
    {
        $objects = ThisModel::searchByFilter($request);

        return Datatables::of($objects)
            ->addColumn('image', function ($object) {
                return '<img class="thumbnail img-preview" width="100px" height="100px" src="' . ($object->image ? $object->image->path : '') . '">';
            })
            ->editColumn('created_at', function ($object) {
                return Carbon::parse($object->created_at)->format("d/m/Y");
            })
            ->editColumn('updated_by', function ($object) {
                return $object->user_update->name ?? '';
            })
            ->addColumn('action', function ($object) {
                $result = '<a href="' . route($this->route.'.edit',$object->id) .'" title="Sửa" class="btn btn-sm btn-primary edit"><i class="fas fa-pencil-alt"></i></a> ';
                $result .= '<a href="' . route($this->route.'.delete', $object->id) . '" title="Khóa" class="btn btn-sm btn-danger confirm"><i class="fas fa-times"></i></a>';

                return $result;
            })
            ->addColumn('title', function ($object) {
                return $object->businessVi->first()->title;
            })
            ->rawColumns(['image', 'status', 'action'])
            ->addIndexColumn()
            ->make(true);
    }

    public function create()
    {
        return view($this->view.'.create', compact([]));
    }

    public function edit($id)
    {
        $object = ThisModel::getDataForEdit($id);
        $object->businessVi = $object->languages->filter(function ($item) {
            return $item->language == 'vi';
        })->first();

        $object->businessEn = $object->languages->filter(function ($item) {
            return $item->language == 'en';
        })->first();

        return view($this->view.'.edit', compact(['object']));
    }

    public function store(BusinessStoreRequest $request)
    {
        DB::beginTransaction();
        try {
            $object = new BusinessSector();
            $object->save();

            $dataVi = array_merge($request->business_vi, ['language' => 'vi', 'business_sector_id' => $object->id]);

            $project_vi = new BusinessSectorLanguage();
            $project_vi->fill($dataVi);
            $project_vi->save();


            if($request->business_en['title']) {
                $dataProjectEn = array_merge($request->business_en, ['language' => 'en', 'business_sector_id' => $object->id]);
                $project_en = new BusinessSectorLanguage();
                $project_en->fill($dataProjectEn);
                $project_en->save();
            }


            FileHelper::uploadFile($request->image, 'business', $object->id, ThisModel::class, 'image');

            DB::commit();
            return $this->responseSuccess();
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }

    public function update(BusinessUpdateRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $object = ThisModel::findOrFail($id);

            BusinessSectorLanguage::query()->where(['language' => 'vi', 'business_sector_id' => $object->id])
                ->update($request->business_vi);

            $project_en = BusinessSectorLanguage::query()->where(['language' => 'en', 'business_sector_id' => $object->id])->first();
            if($project_en) {
                $project_en->update($request->business_en);
            } else {
                if($request->business_en['title']) {
                    $dataProjectEn = array_merge($request->business_en, ['language' => 'en', 'business_sector_id' => $object->id]);
                    $project_en = new BusinessSectorLanguage();
                    $project_en->fill($dataProjectEn);
                    $project_en->save();
                }
            }

            if($request->image) {
                FileHelper::forceDeleteFiles($object->image->id, $object->id, ThisModel::class, 'image');
                FileHelper::uploadFile($request->image, 'business', $object->id, ThisModel::class, 'image');
            }

            DB::commit();
            return $this->responseSuccess();
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
                "message" => "Không thể khóa!",
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


    // Xuất Excel
    public function exportExcel() {
        return (new FastExcel(ThisModel::all()))->download('danh_sach_tai_khoan.xlsx', function ($object) {
            return [
                'ID' => $object->id,
                'Tên' => $object->name,
                'email' => $object->email,
                'Loại' => $object->getTypeUser($object->type),
                'Trạng thái' => $object->status == 0 ? 'Khóa' : 'Hoạt động',
            ];
        });
    }

    // Xuất PDF
    public function exportPDF() {
        $data = ThisModel::all();
        PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        $pdf = PDF::loadView($this->view.'.pdf', compact('data'));
        return $pdf->download('danh_sach_tai_khoan.pdf');
    }
}
