<?php

namespace App\Model\G7;

use App\Model\Product;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    public function product ()
    {
        return $this->belongsTo(Product::class, 'product_id','id');
    }
}
