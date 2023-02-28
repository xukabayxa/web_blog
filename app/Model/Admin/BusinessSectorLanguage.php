<?php

namespace App\Model\Admin;

use App\Model\BaseModel;
use App\Model\Common\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use DB;

class BusinessSectorLanguage extends Model
{
    protected $table = 'business_sectors_languages';

    protected $fillable = ['title', 'description', 'business_sector_id', 'language'];
}
