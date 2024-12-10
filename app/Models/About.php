<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class About extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'title',
        'slug',
        'subtitle',
        'image',
        'description',
        'content',
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