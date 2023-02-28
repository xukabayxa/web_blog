<?php

namespace App\Model\Admin;

use App\Model\BaseModel;
use App\Model\Common\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use DB;

class RegentExperience extends Model
{
    protected $table = 'regent_experience';

    protected $fillable = ['regent_language_id', 'content'];

}
