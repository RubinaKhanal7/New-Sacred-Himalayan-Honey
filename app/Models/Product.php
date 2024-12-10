<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_name',
        'description',
        'cost_price',
        'selling_price',
        'product_quantity',
        'category_id',
        'brand_id',
        'material',
        'product_image',
        'other_images',
        'status',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'other_images' => 'array', // Add this line to cast other_images to an array
    ];

    /**
     * Get the category that owns the product.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the brand that owns the product.
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function orders()
    {
        return $this->belongsToMany(Order::class)->withPivot('quantity');
    }
    
}
