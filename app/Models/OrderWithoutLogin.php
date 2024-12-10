<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class OrderWithoutLogin extends Model
{
    protected $table = 'orders_without_login';

    protected $fillable = [
        'user_name',
        'user_email',
        'product_id',
        'quantity',
        'total_amount',
        'shipping_address',
        'shipping_country',
        'postal_code',
        'payment_method',
        'payment_status',
        'order_status',
        'is_paid',
        'is_shipped',
        'is_delivered',
        'order_date',
        'delivery_date',
        'delivery_time',
    ];
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

}
