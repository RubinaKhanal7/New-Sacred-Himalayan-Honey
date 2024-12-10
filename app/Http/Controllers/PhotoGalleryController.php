<?php

namespace App\Http\Controllers;

use App\Models\PhotoGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Cviebrock\EloquentSluggable\Services\SlugService;

class PhotoGalleryController extends Controller
{
    public function index()
    {
        $galleries = PhotoGallery::latest()->paginate(5);
        return view('backend.photogallery.index', compact('galleries'));
    }

    public function create()
    {
        return view('backend.photogallery.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'img_desc' => 'nullable|string',
            'img.*' => 'required|image|mimes:jpeg,png,jpg,gif,avif,webp,avi|max:2048',
        ]);
    
        try {
            $gallery = new PhotoGallery;
            $gallery->title = $request->title;
            $gallery->img_desc = $request->img_desc;
            $gallery->slug = SlugService::createSlug(PhotoGallery::class, 'slug', $request->title);
    
            // Save each uploaded image
            $convertedImages = [];
            foreach ($request->file('img') as $image) {
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/photogallery/'), $imageName);
                $convertedImages[] = 'uploads/photogallery/' . $imageName;
            }
    
            $gallery->img = json_encode($convertedImages); // Store as JSON array or use another suitable format
            $gallery->save();
    
            return redirect()->route('backend.photogalleries.index')->with('success', 'Gallery created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error creating gallery. Please try again.');
        }
    }
    

    public function edit($id)
{
    $gallery = PhotoGallery::findOrFail($id);
    $gallery->img = json_decode($gallery->img, true);
    return view('backend.photogallery.update', compact('gallery'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'title' => 'required|string',
        'img_desc' => 'nullable|string',
        'img.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,avif,webp|max:2048',
    ]);

    try {
        $gallery = PhotoGallery::findOrFail($id);
        $gallery->title = $request->title;
        $gallery->img_desc = $request->img_desc;
        $gallery->slug = SlugService::createSlug(PhotoGallery::class, 'slug', $request->title);

        // Handle removed images
        $currentImages = json_decode($gallery->img, true) ?? [];
        $removedImages = json_decode($request->removed_images, true) ?? [];
        
        foreach ($removedImages as $removedImage) {
            if (($key = array_search($removedImage, $currentImages)) !== false) {
                unset($currentImages[$key]);
                // Delete the file from storage
                File::delete(public_path($removedImage));
            }
        }

        // Handle new uploaded images
        if ($request->hasFile('img')) {
            foreach ($request->file('img') as $image) {
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/photogallery/'), $imageName);
                $currentImages[] = 'uploads/photogallery/' . $imageName;
            }
        }

        $gallery->img = json_encode(array_values($currentImages));
        $gallery->save();

        return redirect()->route('backend.photogalleries.index')->with('success', 'Gallery updated successfully.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Error updating gallery. Please try again.');
    }
}

    public function destroy($id)
    {
        $gallery = PhotoGallery::findOrFail($id);
        
        // Delete images associated with the gallery
        if (!empty($gallery->img)) {
            $images = json_decode($gallery->img, true);
            foreach ($images as $image) {
                File::delete(public_path($image));
            }
        }

        $gallery->delete();
        return redirect()->route('backend.photogalleries.index')->with('success', 'Gallery deleted successfully.');
    }
}
