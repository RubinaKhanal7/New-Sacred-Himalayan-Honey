<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentWithoutLogin extends Model
{
    protected $table = 'payments_without_login';

    protected $fillable = [
        'order_id',
        'product_id',
        'amount',
        'payment_method',
        'payment_status',
    ];
}
