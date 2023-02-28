<?php

namespace App\Http\View\Composers;

use App\Model\Admin\Category;
use App\Model\Admin\Config;
use App\Model\Admin\Store;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HeaderComposer
{
    /**
     * Compose Settings Menu
     * @param View $view
     */
    public function compose(View $view)
    {
        $config = Config::query()->get()->first();
        $cartCollection = \Cart::getContent();
       $total = \Cart::getTotal();

       $productWishlist = \Cookie::get('productWishList');

       $productWishListArray = json_decode($productWishlist, true);

        if(! $productWishListArray) {
            $productWishListArray = [];
        }
       $view->with(['config' => $config, 'cartItems' => $cartCollection, 'totalCart' => $total, 'productWishlist' => $productWishListArray]);
    }
}
