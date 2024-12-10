<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'order_id',
        'amount',
        'transaction_date',
        'payment_id',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'transaction_date' => 'datetime',
    ];

    /**
     * Get the user that owns the transaction.
     */
    public function user()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get the order associated with the transaction.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Get the payment associated with the transaction.
     */
    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}
