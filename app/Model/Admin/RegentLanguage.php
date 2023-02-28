<?php

namespace App\Model\Admin;

use App\Model\BaseModel;
use App\Model\Common\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use DB;

class RegentLanguage extends Model
{
    protected $table = 'regent_language';

    protected $fillable = ['full_name', 'regent_id', 'language', 'address', 'role', 'description'];

    public function image()
    {
        return $this->morphOne(File::class, 'model')->where('custom_field', 'image');
    }

    public function regent()
    {
        return $this->belongsTo(Regent::class, 'regent_id');
    }

    public function experience()
    {
        return $this->hasMany(RegentExperience::class, 'regent_language_id');
    }
}
