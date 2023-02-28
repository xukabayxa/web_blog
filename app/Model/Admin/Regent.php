<?php

namespace App\Model\Admin;

use App\Model\BaseModel;
use App\Model\Common\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use DB;

class Regent extends BaseModel
{
    protected $table = 'regent';

    public function image()
    {
        return $this->morphOne(File::class, 'model')->where('custom_field', 'image');
    }

    public function canEdit()
    {
        return Auth::user()->id = $this->create_by;
    }

    public function canDelete()
    {
        return true;
    }

    public static function searchByFilter($request)
    {
        $result = self::query();

        if (!empty($request->name)) {
            $result = $result->where('name', 'like', '%' . $request->name . '%');
        }

        if (!empty($request->email)) {
            $result = $result->where('email', 'like', '%' . $request->email . '%');
        }

        $result = $result->orderBy('created_at', 'desc')->get();

        return $result;
    }

    public static function getForSelect()
    {
        return self::select(['id', 'name'])
            ->orderBy('name', 'ASC')
            ->get();
    }

    public static function getDataForEdit($id)
    {
        return self::query()->with(['image', 'regentLanguages'])
            ->where('id', $id)
            ->firstOrFail();
    }

    public static function getDataForShow($id)
    {
        return self::where('id', $id)
            ->firstOrFail();
    }

    public function regentLanguages()
    {
        return $this->hasMany(RegentLanguage::class, 'regent_id');
    }

    public function regentVi()
    {
        return $this->regentLanguages()->where('language', 'vi');
    }

    public function regentEn()
    {
        return $this->regentLanguages()->where('language', 'en');
    }

}
