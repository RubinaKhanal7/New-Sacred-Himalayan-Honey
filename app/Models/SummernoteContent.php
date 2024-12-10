<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Facades\Image;

class SummernoteContent extends Model
{
    public function processContent($content)
    {
        if ($content != '') {
            $dom = new \DomDocument();
            $content = preg_replace('/<(\w+):(\w+)>/', '&lt;\1:\2&gt;', $content);
            $content = preg_replace('/<\/(\w+):(\w+)>/', '&lt;/\1:\2&gt;', $content);

            libxml_use_internal_errors(true);
            $dom->loadHtml('<meta http-equiv="Content-Type" content="charset=utf-8" />' . $content);
            libxml_clear_errors();
            $images = $dom->getElementsByTagName('img');

            // Loop through each <img> tag in the submitted content
            foreach ($images as $img) {
                $src = $img->getAttribute('src');
                $src = str_replace('http://127.0.0.1:8000/', 'http://127.0.0.1:8000/', $src);
                $img->removeAttribute('src');
                $img->setAttribute('src', $src);

                // If the image source is a data URL, process it
                if (preg_match('/data:image/', $src)) {
                    preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                    $mimetype = $groups['mime'];

                    $filename = uniqid();
                    $filepath = 'uploads/country/content' . $filename . '.' . $mimetype;

                    // Use Intervention Image to encode and save the image
                    $image = Image::make($src)
                        ->encode($mimetype, 100)
                        ->save(public_path($filepath));

                    // Update the image source to the newly saved image URL
                    $new_src = asset($filepath);
                    $img->removeAttribute('src');
                    $img->setAttribute('src', $new_src);
                }
            }

            // Remove unnecessary HTML tags from the content
            $html_cut = preg_replace('~<(?:!DOCTYPE|/?(?:html|body|head|meta))[^>]>\s~i', '', $dom->saveHTML());
            return $html_cut;
        } else {
            return $content;
        }
    }
}
