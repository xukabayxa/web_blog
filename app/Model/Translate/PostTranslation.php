<?php

namespace App\Model\Translate;

use Auth;
use App\Model\BaseModel;

class PostTranslation extends BaseModel
{
    protected $dates = ['created_at', 'updated_at'];
    public $fillable = ['name'];

}
