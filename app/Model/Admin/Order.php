<?php

namespace App\Model\Admin;

use App\Model\BaseModel;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = ['id', 'customer_name', 'customer_address',
        'customer_email', 'customer_phone', 'customer_required', 'payment_method', 'created_at', 'updated_at', 'code'];

    protected $appends = ['total_price'];

    public const MOI = 10;
    public const DUYET = 20;
    public const THANH_CONG = 30;
    public const HUY = 40;

    public const PAYMENT_METHODS = [1=> 'Thanh toán khi nhận hàng - COD', 0 => 'Chuyển khoản ngân hàng'];

    public const STATUSES = [
        [
            'id' => self::MOI,
            'name' => 'Mới',
            'type' => 'danger'
        ],
        [
            'id' => self::DUYET,
            'name' => 'Đã duyệt',
            'type' => 'success'
        ],
         [
            'id' => self::THANH_CONG,
            'name' => 'Thành công',
            'type' => 'success'
        ],
         [
            'id' => self::HUY,
            'name' => 'Hủy',
            'type' => 'danger'
        ],
    ];

    public function details()
    {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }

    public function getTotalPriceAttribute()
    {
        return $this->details->sum(function ($detail) {
            return $detail->price * $detail->qty;
        });
    }

    public static function searchByFilter($request)
    {
        $result = self::query();

        if (!empty($request->code)) {
            $result = $result->where('code', 'like', '%' . $request->code . '%');
        }

        $result = $result->orderBy('created_at', 'desc')->get();
        return $result;
    }
}
