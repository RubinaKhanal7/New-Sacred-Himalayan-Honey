<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
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
        'product_name',
    ];

    /**
     * Get the user that owns the wishlist.
     */
    public function user()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get the product associated with the wishlist.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
