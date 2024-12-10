<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class VideoGallery extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = ['title', 'slug', 'url'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function getVideoIdAttribute()
    {
        return $this->extractVideoId($this->url);
    }

    private function extractVideoId($url)
    {
        $videoId = null;
        $url = parse_url($url);
        
        if (isset($url['query'])) {
            parse_str($url['query'], $query);
            if (isset($query['v'])) {
                $videoId = $query['v'];
            }
        }
        
        if (!$videoId && isset($url['path'])) {
            $path = explode('/', trim($url['path'], '/'));
            $videoId = end($path);
        }
        
        return $videoId;
    }
}