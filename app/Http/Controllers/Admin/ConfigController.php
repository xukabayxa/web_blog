<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Model\Admin\Config as ThisModel;
use Yajra\DataTables\DataTables;
use Validator;
use \stdClass;
use Response;
use App\Http\Controllers\Controller;
use App\Helpers\FileHelper;
use \Carbon\Carbon;
use Illuminate\Validation\Rule;
use DB;

class ConfigController extends Controller
{
	protected $view = 'admin.configs';
	protected $route = 'Config';

	public function edit()
	{
		$id = 1;
		$object = ThisModel::getDataForEdit($id);
		return view($this->view.'.edit', compact('object'));
	}

	public function update(Request $request)
	{
		$validate = Validator::make(
			$request->all(),
			[
				'web_title' => 'required|max:255',
				'hotline' => 'required|max:10',
				'zalo' => 'required|max:10',
				'email' => 'required|email',
				'facebook' => 'nullable|max:255',
				'image' => 'nullable|file|mimes:jpg,jpeg,png|max:3000',
                'favicon' => 'nullable|file|mimes:jpg,jpeg,png|max:3000',
                'location' => 'nullable|max:255',
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
			$object = ThisModel::where('id',1)->first();
			$object->web_title = $request->web_title;
			$object->hotline = $request->hotline;
			$object->web_des = $request->web_des;
			$object->zalo = $request->zalo;
			$object->address_company = $request->address_company;
			$object->address_center_insurance = $request->address_center_insurance;
			$object->email = $request->email;
			$object->facebook = $request->facebook;
			$object->twitter = $request->twitter;
			$object->instagram = $request->instagram;
			$object->youtube = $request->youtube;
			$object->location = $request->location;
			$object->introduction = $request->introduction;
			$object->address = $request->address;
			$object->video = $request->video;
			$object->slogan_vi = $request->slogan_vi;
			$object->slogan_en = $request->slogan_en;

			$object->click_call = $request->click_call;
			$object->facebook_chat = $request->facebook_chat;
			$object->zalo_chat = $request->zalo_chat;
			$object->phone_switchboard = $request->phone_switchboard;

			$object->des_homepage = $request->des_homepage;
			$object->des_aboutpage = $request->des_aboutpage;
			$object->des_blogpage = $request->des_blogpage;
			$object->des_contactpage = $request->des_contactpage;

			$object->save();

			if($request->image) {
				if($object->image) {
					FileHelper::forceDeleteFiles($object->image->id, $object->id, ThisModel::class, 'image');
				}
				FileHelper::uploadFile($request->image, 'configs', $object->id, ThisModel::class, 'image',5);
			}

            if($request->favicon) {
                if($object->favicon) {
                    FileHelper::forceDeleteFiles($object->favicon->id, $object->id, ThisModel::class, 'favicon');
                }
                FileHelper::uploadFile($request->favicon, 'configs', $object->id, ThisModel::class, 'favicon',7);
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
}
