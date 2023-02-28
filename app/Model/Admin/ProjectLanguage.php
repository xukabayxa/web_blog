<?php

namespace App\Model\Admin;

use App\Model\BaseModel;
use App\Model\Common\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use DB;

class ProjectLanguage extends Model
{
    protected $table = 'project_languages';

    protected $fillable = ['title', 'des', 'short_des', 'project_id', 'address', 'language'];
}
