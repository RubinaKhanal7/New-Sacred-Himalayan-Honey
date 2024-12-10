<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id',
        'shipment_date',
        'carrier',
        'tracking_number',
        'shipping_cost',
        'delivery_date',
        'status',
    ];

    /**
     * Get the order associated with the shipment.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
