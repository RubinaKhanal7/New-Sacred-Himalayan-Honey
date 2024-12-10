<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'product_id',
        'product_quantity',
    ];

    /**
     * Get the customer associated with the cart.
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'user_id');
    }

    /**
     * Get the product associated with the cart.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
