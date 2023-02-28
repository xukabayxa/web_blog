<?php

namespace App\Http\Controllers\Front;

use App\Mail\NewOrder;
use App\Model\Admin\Config;
use App\Model\Admin\Order;
use App\Model\Admin\OrderDetail;
use App\Model\Admin\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    // trang giỏ hàng
    public function index()
    {
        $cartCollection = \Cart::getContent();
        $total = \Cart::getTotal();

        return view( 'site.cart', compact('cartCollection', 'total'));
    }

    public function addItem(Request $request, $productId)
    {
        $product = Product::query()->find($productId);

        \Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => $request->qty ? (int)$request->qty : 1,
            'attributes' => [
                'image' => $product->image->path ?? ''
            ]
        ]);

        return \Response::json(['success' => true, 'items' => \Cart::getContent(), 'total' => \Cart::getTotal(),
            'count' => \Cart::getContent()->sum('quantity')]);
    }

    public function updateItem(Request $request)
    {
        \Cart::update($request->product_id, array(
            'quantity' => array(
                'relative' => false,
                'value' => $request->qty
            ),
        ));

        return \Response::json(['success' => true, 'items' => \Cart::getContent(), 'total' => \Cart::getTotal(),
            'count' => \Cart::getContent()->sum('quantity')]);

    }

    public function removeItem(Request $request)
    {
        \Cart::remove($request->product_id);

        return \Response::json(['success' => true, 'items' => \Cart::getContent(), 'total' => \Cart::getTotal(),
            'count' => \Cart::getContent()->sum('quantity')]);
    }

    // trang thanh toán
    public function checkout(Request $request) {
        $cartCollection = \Cart::getContent();
        $total = \Cart::getTotal();

        return view('site.checkout', compact('cartCollection', 'total'));
    }

    // submit đặt hàng
    public function checkoutSubmit(Request $request)
    {
        DB::beginTransaction();
        try {
            $translate = [
                'customer_name.required' => 'Vui lòng nhập họ tên',
                'customer_phone.required' => 'Vui lòng nhập số điện thoại',
                'customer_address.required' => 'Vui lòng nhập địa chỉ',
                'payment_method.required' => 'Vui lòng chọn phương thức thanh toán',
                'customer_email.required' => 'Vui lòng nhập email',
            ];

            $validate = Validator::make(
                $request->all(),
                [
                    'customer_name' => 'required',
                    'customer_phone' => 'required',
                    'customer_address' => 'required',
                    'payment_method' => 'required',
                    'customer_email' => 'required',
                ],
                $translate
            );

            $json = new \stdClass();

            if ($validate->fails()) {
                $json->success = false;
                $json->errors = $validate->errors();
                $json->message = "Thao tác thất bại!";
                return Response::json($json);
            }

            $lastId = Order::query()->latest('id')->first()->id ?? 1;

            $order = Order::query()->create([
                'customer_name' => $request->customer_name,
                'customer_phone' => $request->customer_phone,
                'customer_email' => $request->customer_email,
                'customer_address' => $request->customer_address,
                'customer_required' => $request->customer_required,
                'payment_method' => $request->payment_method,
                'code' => 'ORDER' . date('Ymd') . '-' . $lastId
            ]);

            foreach ($request->items as $item) {
                $detail = new OrderDetail();
                $detail->order_id = $order->id;
                $detail->product_id = $item['id'];
                $detail->qty = $item['quantity'];
                $detail->price = $item['price'];

                $detail->save();
            }

            \Cart::clear();

            $config = Config::query()->first();

            // gửi mail đặt hàng thành công cho khách hàng
//            Mail::to($request->customer_email)->send(new NewOrder($order, $config, 'customer'));

//            // gửi mail thông báo có đơn hàng mới cho admin
//            $users = User::query()->where('status', 1)->get();
//            foreach ($users as $user) {
//                Mail::to($user->email)->send(new NewOrder($order, $config, 'admin'));
//            }

            DB::commit();
            return Response::json(['success' => true, 'order_code' => $order->code]);
        } catch (\Exception $exception) {
            DB::rollBack();
            dd($exception->getMessage());
        }

    }

    // trả về trang đặt hàng thành công
    public function checkoutSuccess($orderCode, Request $request)
    {
        $order = Order::query()->where('code', $orderCode)->first();

        if ($order) {
            Cache::put($order->code, $order, 5);
            if (Cache::has($order->code)) {
                return view('site.checkout_success', compact('order'));
            } else {
                return redirect()->route('homePage');
            }
        }

        return redirect()->route('homePage');
    }

    // trang sản phẩm yêu thích
    public function wishList() {
        $productWishlist = \Cookie::get('productWishList');

        $productWishListArray = json_decode($productWishlist, true);

        if(! $productWishListArray) {
            $productWishListArray = [];
        }

        $products = Product::query()->with('image')->whereIn('id', $productWishListArray)->get();

        return view('site.wishlist', compact('products'));
    }

    // thêm, gỡ sản phẩm yêu thích
    public function addToWishList($productId, Request $request) {
        $product = Product::query()->find($productId);
        $countProductWishList = 1;
        $message = 'Đã thêm vào danh sách yêu thích';

        $type = 'add';

        $productWishListArray = [];

        if(! $request->cookie('productWishList')) {
            $collect = collect([$product->id]);
            $productWishList = cookie()->forever('productWishList', $collect);
        } else {
            $productWishList = $request->cookie('productWishList');
            $productWishListArray = json_decode($productWishList, true);

            if(in_array($product->id, $productWishListArray)) {
                $productWishListArray = array_filter($productWishListArray, function ($item) use ($product) {
                    return $item != $product->id;
                });

                $type = 'remove';
                $message = 'Đã gỡ khỏi danh sách yêu thích';
            } else {
                array_push($productWishListArray, $product->id);
            }

            $collect = collect(array_unique($productWishListArray));
            $productWishList = cookie()->forever('productWishList', $collect);

            $countProductWishList = count($productWishListArray);
        }

        return response()->json(['success' => true, 'message' => $message, 'type' => $type,
            'countProductWishlist' => $countProductWishList])->withCookie($productWishList);
    }
}
