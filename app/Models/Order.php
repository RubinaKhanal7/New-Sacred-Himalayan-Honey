<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_date',
        'total_amount',
        'payment_method',
        'payment_status',
        'shipping_address',
        'shipping_country',
        'postal_code',
        'shipping_cost',
        'tax_amount',
        'order_status',
        'is_paid',
        'is_shipped',
        'is_delivered',
        'delivery_date',
        'delivery_time',
        'product_ids',
        'quantities',
        'paypal_order_id',
        'paypal_payer_id',
        'paypal_payment_id',
    ];

    protected $casts = [
        'order_date' => 'datetime',
        'delivery_date' => 'datetime',
        'is_paid' => 'boolean',
        'is_shipped' => 'boolean',
        'is_delivered' => 'boolean',
        'product_ids' => 'array',
        'quantities' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'user_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }
    
}