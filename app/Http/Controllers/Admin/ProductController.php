<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Products\ProductStoreRequest;
use App\Http\Requests\Products\ProductUpdateRequest;
use App\Model\Admin\AttributeValue;
use App\Model\Admin\Manufacturer;
use App\Model\Admin\Post;
use App\Model\Admin\Product;
use App\Model\Admin\ProductCategorySpecial;
use App\Model\Admin\ProductVideo;
use App\Model\Admin\Tag;
use Cassandra\Exception\ProtocolException;
use Illuminate\Http\Request;
use App\Model\Admin\Product as ThisModel;
use App\Model\Common\Unit;
use Yajra\DataTables\DataTables;
use Validator;
use \stdClass;
use Response;
use Rap2hpoutre\FastExcel\FastExcel;
use PDF;
use App\Http\Controllers\Controller;
use \Carbon\Carbon;
use DB;
use App\Helpers\FileHelper;
use App\Model\Common\User;
use App\Model\Common\ActivityLog;
use Auth;

class ProductController extends Controller
{
	protected $view = 'admin.products';
	protected $route = 'Product';

	public function index()
	{
		return view($this->view.'.index');
	}

	// Hàm lấy data cho bảng list
    public function searchData(Request $request)
    {
		$objects = ThisModel::searchByFilter($request);
        return Datatables::of($objects)
			->addColumn('name', function ($object) {
				return $object->name;
			})
			->editColumn('base_price', function ($object) {
				return formatCurrent($object->base_price);
			})
			->editColumn('price', function ($object) {
				return formatCurrent($object->price);
			})
			->editColumn('created_at', function ($object) {
				return Carbon::parse($object->created_at)->format("d/m/Y");
			})
			->editColumn('created_by', function ($object) {
				return $object->user_create->name ? $object->user_create->name : '';
			})
			->editColumn('updated_by', function ($object) {
				return $object->user_update->name ? $object->user_update->name : '';
			})
			->editColumn('cate_id', function ($object) {
					return $object->category ? $object->category->name : '';
			})
            ->addColumn('category_special', function ($object) {
                return $object->category_specials->implode('name', ', ');
            })
			->addColumn('action', function ($object) {
                $result = '<div class="btn-group btn-action">
                <button class="btn btn-info btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class = "fa fa-cog"></i>
                </button>
                <div class="dropdown-menu">';

                if($object->canEdit()) {
                    $result = $result . ' <a href="'. route($this->route.'.edit', $object->id) .'" title="sửa" class="dropdown-item"><i class="fa fa-angle-right"></i>Sửa</a>';
                }
                if ($object->canDelete()) {
                    $result = $result . ' <a href="' . route($this->route.'.delete', $object->id) . '" title="xóa" class="dropdown-item confirm"><i class="fa fa-angle-right"></i>Xóa</a>';

                }

                $result = $result . ' <a href="" title="thêm vào danh mục đặc biệt" class="dropdown-item add-category-special"><i class="fa fa-angle-right"></i>Thêm vào danh mục đặc biệt</a>';
                $result = $result . '</div></div>';
                return $result;
			})
			->addIndexColumn()
			->rawColumns(['action'])
			->make(true);
    }

	public function create()
	{
        $tags = Tag::query()->where('type', Tag::TYPE_PRODUCT)->latest()->get();

		return view($this->view.'.create', compact('tags'));
	}

	public function store(ProductStoreRequest $request)
	{
		$json = new stdClass();
		DB::beginTransaction();
		try {
			$object = new ThisModel();
			$object->name = $request->name;
			$object->cate_id = $request->cate_id;
			$object->intro = $request->intro;
			$object->short_des = $request->short_des;
			$object->body = $request->body;
			$object->base_price = $request->base_price;
			$object->price = $request->price;
			$object->status = $request->status;
			$object->manufacturer_id = $request->manufacturer_id;
			$object->origin_id = $request->origin_id;
			$object->title_seo = $request->title_seo;
			$object->content_seo = $request->content_seo;
            $object->url_custom = $request->url_custom;
            $object->use_url_custom = ($request->use_url_custom == 'true' || $request->use_url_custom == '1') ? 1 : 0;
            $object->state = $request->state ?? Product::CON_HANG;
            $object->is_pin = $request->is_pin ?? Product::NOT_PIN;

			$object->save();

			FileHelper::uploadFile($request->image, 'products', $object->id, ThisModel::class, 'image',1);

			$object->syncGalleries($request->galleries);

            if(isset($request->all()['attributes'])) {
                foreach ($request->all()['attributes'] as $attribute) {
                    AttributeValue::query()->create([
                        'attribute_id' => $attribute['attribute_id'],
                        'value' => $attribute['value'],
                        'product_id' => $object->id,
                    ]);
                }
            }

            if(isset($request->all()['videos'])) {
                foreach ($request->all()['videos'] as $video) {
                    ProductVideo::query()->create([
                        'link' => $video['link'],
                        'video' => $video['video'],
                        'product_id' => $object->id,
                    ]);
                }
            }

            if(isset($request->all()['tag_ids'])) {
                $object->addTags($request->all()['tag_ids']);
            }

			DB::commit();
			$json->success = true;
			$json->message = "Thao tác thành công!";
			return Response::json($json);
		} catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
	}

	public function edit($id)
	{
		$object = ThisModel::getDataForEdit($id);
        $tags = Tag::query()->where('type', Tag::TYPE_PRODUCT)->latest()->get();
        $object->tag_ids = $object->tags->pluck('id')->toArray();

        return view($this->view.'.edit', compact('object','tags'));
	}

	public function update(ProductUpdateRequest $request, $id)
	{
		$json = new stdClass();

		DB::beginTransaction();
		try {
			$object = ThisModel::findOrFail($id);

			if (!$object->canEdit()) {
				$json->success = false;
				$json->message = "Bạn không có quyền sửa hàng hóa này";
				return Response::json($json);
			}

			$object->name = $request->name;
			$object->cate_id = $request->cate_id;
			$object->intro = $request->intro;
			$object->short_des = $request->short_des;
			$object->body = $request->body;
			$object->base_price = $request->base_price;
			$object->price = $request->price;
			$object->status = $request->status;
			$object->manufacturer_id = $request->manufacturer_id;
			$object->origin_id = $request->origin_id;
            $object->title_seo = $request->title_seo;
            $object->content_seo = $request->content_seo;
            $object->url_custom = $request->url_custom;
            $object->use_url_custom = ($request->use_url_custom == 'true' || $request->use_url_custom == '1') ? 1 : 0;
            $object->state = $request->state ?? Product::CON_HANG;
            $object->is_pin = $request->is_pin ?? Product::NOT_PIN;

			$object->save();

			if($request->image) {
				if($object->image) {
					FileHelper::forceDeleteFiles($object->image->id, $object->id, ThisModel::class, 'image');
				}
				FileHelper::uploadFile($request->image, 'products', $object->id, ThisModel::class, 'image',1);
			}

			$object->syncGalleries($request->galleries);

            if(isset($request->all()['attributes'])) {
                AttributeValue::query()->where('product_id', $object->id)->delete();
                foreach ($request->all()['attributes'] as $attribute) {
                    AttributeValue::query()->create([
                        'attribute_id' => $attribute['attribute_id'],
                        'value' => $attribute['value'],
                        'product_id' => $object->id,
                    ]);
                }
            }

            if(isset($request->all()['videos'])) {
                ProductVideo::query()->where('product_id', $object->id)->delete();
                foreach ($request->all()['videos'] as $video) {
                    ProductVideo::query()->create([
                        'link' =>$video['link'],
                        'video' => $video['video'],
                        'product_id' => $object->id,
                    ]);
                }
            }

            if(isset($request->all()['tag_ids'])) {
                $object->updateTags($request->all()['tag_ids']);
            } else {
                $object->deleteTags();
            }

			DB::commit();
			ActivityLog::createRecord("Cập nhật hàng hóa thành công", route('Product.edit', $object->id, false));
			$json->success = true;
			$json->message = "Thao tác thành công!";
			return Response::json($json);
		} catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
	}

	public function delete($id)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

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


	public function getData(Request $request, $id) {
        $json = new stdclass();
        $json->success = true;
        $json->data = ThisModel::getDataForEdit($id);
        return Response::json($json);
	}

	// Xuất Excel
	public function exportExcel(Request $request)
	{
		return (new FastExcel(ThisModel::searchByFilter($request)))->download('danh_sach_hang_hoa.xlsx', function ($object) {
			if(Auth::user()->type == User::G7 || Auth::user()->type == User::NHOM_G7) {
				return [
					'ID' => $object->id,
					'Mã' => $object->code,
					'Tên' => $object->name,
					'Loại' => $object->category->name,
					'Giá đề xuất' => formatCurrency($object->price),
					'Giá bán' => formatCurrency($object->g7_price->price),
					'Điểm tích lũy' => $object->point,
					'Trạng thái' => $object->status == 0 ? 'Khóa' : 'Hoạt động',
				];
			} else {
				return [
					'ID' => $object->id,
					'Mã' => $object->code,
					'Tên' => $object->name,
					'Loại' => $object->category->name,
					'Giá đề xuất' => formatCurrency($object->price),
					'Điểm tích lũy' => $object->point,
					'Trạng thái' => $object->status == 0 ? 'Khóa' : 'Hoạt động',
				];
			}
		});
	}

	// Xuất PDF
	public function exportPDF(Request $request) {
		$data = ThisModel::searchByFilter($request);
		$pdf = PDF::loadView($this->view.'.pdf', compact('data'));
		return $pdf->download('danh_sach_hang_hoa.pdf');
	}

    public function addToCategorySpecial(Request $request) {
        $product = Product::query()->find($request->product_id);

        $product->category_specials()->sync($request->category_special_ids);

        return Response::json(['success' => true, 'message' => 'Thêm sản phẩm vào danh mục đặc biệt thành công']);
    }

    // xóa nhiều sản phẩm
    public function actDelete(Request $request) {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        $product_ids = explode(',', $request->product_ids);

        Product::query()->whereIn('id', $product_ids)->delete();

        $message = array(
            "message" => "Thao tác thành công!",
            "alert-type" => "success"
        );

        return redirect()->route($this->route.'.index')->with($message);
    }
}
