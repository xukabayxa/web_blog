<?php

namespace App\Http\Controllers\Admin;

//use App\Http\Requests\Attorneys\AttorneyStoreRequest;
//use App\Http\Requests\Attorneys\AttorneyUpdateRequest;
use App\Http\Requests\Regent\RegentStoreRequest;
use App\Model\Admin\Regent;
use App\Model\Admin\RegentExperience;
use App\Model\Admin\RegentLanguage;
use Illuminate\Http\Request;
use App\Model\Admin\Regent as ThisModel;
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

class RegentController extends Controller
{
    use ResponseTrait;

    protected $view = 'admin.regent';
    protected $route = 'regent';

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
            ->addColumn('action', function ($object) {
                $result = '<a href="' . route($this->route.'.edit',$object->id) .'" title="Sửa" class="btn btn-sm btn-primary edit"><i class="fas fa-pencil-alt"></i></a> ';
                $result .= '<a href="' . route($this->route.'.delete', $object->id) . '" title="Khóa" class="btn btn-sm btn-danger confirm"><i class="fas fa-times"></i></a>';

                return $result;
            })
            ->editColumn('full_name', function ($object) {
                return $object->regentVi->first()->full_name;
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
        $object->regentVi = $object->regentLanguages->filter(function ($item) {
                return $item->language == 'vi';
            })->first();
        $object->regentVi->experience = $object->regentVi->experience;

        $object->regentEn = $object->regentLanguages->filter(function ($item) {
                return $item->language == 'en';
            })->first();

        if($object->regentEn) {
            $object->regentEn->experience = $object->regentEn->experience;
        }

        return view($this->view.'.edit', compact(['object']));
    }

    public function store(RegentStoreRequest $request)
    {
        DB::beginTransaction();
        try {
            $regent = new Regent();
            $regent->phone_number = $request->phone_number;
            $regent->sex = $request->sex;
            $regent->email = $request->email;
            $regent->sort_order = $request->sort_order;
            $regent->date_of_birth = $request->date_of_birth;
            $regent->save();

            $dataRegentVi = array_merge($request->regent_vi, ['language' => 'vi', 'regent_id' => $regent->id]);

            $regent_vi = new RegentLanguage();
            $regent_vi->fill($dataRegentVi);
            $regent_vi->save();

            if($request->regent_vi && $request->regent_vi['experience']) {
                foreach ($request->regent_vi['experience'] as $experience) {
                    $regent_vi->experience()->create(array_merge($experience, ['regent_language_id' => $regent_vi->id]));
                }
            }

            if($request->regent_en && $request->regent_en['full_name']) {
                $dataRegentEn = array_merge($request->regent_en, ['language' => 'en', 'regent_id' => $regent->id]);
                $regent_en = new RegentLanguage();
                $regent_en->fill($dataRegentEn);
                $regent_en->save();

                if($request->regent_en && $request->regent_en['experience']) {
                    foreach ($request->regent_en['experience'] as $experience) {
                        $regent_en->experience()->create(array_merge($experience, ['regent_language_id' => $regent_en->id]));
                    }
                }
            }


            FileHelper::uploadFile($request->image, 'regent', $regent->id, ThisModel::class, 'image', 9);

            DB::commit();
            return $this->responseSuccess();
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }

    public function update(RegentStoreRequest $request, $id)
    {
       DB::beginTransaction();
        try {
            $regent = ThisModel::findOrFail($id);
            $regent->phone_number = $request->phone_number;
            $regent->sex = $request->sex;
            $regent->email = $request->email;
            $regent->sort_order = $request->sort_order;
            $regent->date_of_birth = $request->date_of_birth;
            $regent->save();


            $regentVi = RegentLanguage::query()->where(['language' => 'vi', 'regent_id' => $regent->id])->first();
            $regentVi->update($request->regent_vi);

            $regentEn = RegentLanguage::query()->where(['language' => 'en', 'regent_id' => $regent->id])->first();
            if($regentEn) {
                $regentEn->update($request->regent_en);
            } else {
                if($request->regent_en['full_name']) {
                    $dataRegentEn = array_merge($request->regent_en, ['language' => 'en', 'regent_id' => $regent->id]);
                    $regentEn = new RegentLanguage();
                    $regentEn->fill($dataRegentEn);
                    $regentEn->save();
                }
            }

            if(@$request->regent_vi['experience']) {
                RegentExperience::query()->where('regent_language_id', $regentVi->id)->delete();
                foreach ($request->regent_vi['experience'] as $experience) {
                    $regentVi->experience()->create(array_merge($experience, ['regent_language_id' => $regentVi->id]));
                }
            } else {
                RegentExperience::query()->where('regent_language_id', $regentVi->id)->delete();
            }

            if(@$request->regent_en['experience'] || $regentEn) {

                RegentExperience::query()->where('regent_language_id', $regentEn->id)->delete();
                if(! empty($request->regent_en['experience'])) {
                    foreach ($request->regent_en['experience'] as $experience) {
                        $regentEn->experience()->create(array_merge($experience, ['regent_language_id' => $regentEn->id]));
                    }
                }
            }

            if($request->image) {
                FileHelper::forceDeleteFiles($regent->image->id, $regent->id, ThisModel::class, 'image');
                FileHelper::uploadFile($request->image, 'regent', $regent->id, ThisModel::class, 'image', 9);
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
