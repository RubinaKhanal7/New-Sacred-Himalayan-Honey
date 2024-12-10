<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PhotoGallery extends Model
{
    use HasFactory, Sluggable;
    protected $fillable = ['title', 'slug', 'img_desc', 'img'];


    protected $casts = [
        'img' => 'array'
    ];
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
