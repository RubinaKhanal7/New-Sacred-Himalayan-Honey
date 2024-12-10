<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id',
        'product_quantity',
    ];

    /**
     * Get the product associated with the inventory.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
