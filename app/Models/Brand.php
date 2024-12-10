<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'brand_name',
        'category_id',
    ];

    /**
     * Get the category that owns the brand.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
