<?php

namespace App\Http\Controllers;

use App\Models\VideoGallery;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;

class VideoGalleryController extends Controller
{
    public function index()
    {
        $videos = VideoGallery::latest()->paginate(5);

        return view('backend.videogallery.index', ['videos' => $videos, 'page_title' => 'Video Gallery']);
    }

    public function create()
    {
        return view('backend.videogallery.create', ['page_title' => 'Add VideoGallerys']);
    }

    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string',
        'url' => 'required|url',
    ]);

    try {
        $video = new VideoGallery();
        $video->title = $request->title;
        $video->slug = SlugService::createSlug(VideoGallery::class, 'slug', $request->title);
        $video->url = $request->url;

        if ($video->save()) {
            return redirect()->route('backend.videogalleries.index')->with('success', 'Success! Video created.');
        } else {
            return redirect()->back()->with('error', 'Error! Video not created.');
        }
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Error! Something went wrong.');
    }
}


    public function edit($id)
    {
        $video = VideoGallery::find($id);

        return view('backend.videogallery.update', ['video' => $video, 'page_title' => 'Update Video Gallery']);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string',
            'url' => 'nullable',
        ]);
        try {
            $video = VideoGallery::findOrFail($id);

            $video->title = $request->title ?? '';
            $video->slug = SlugService::createSlug(VideoGallery::class, 'slug', $request->title);
            $video->url = $request->url;

            if ($video->save()) {
                return redirect()->route('backend.videogalleries.index')->with('success', 'Success! Video Updated.');
            } else {
                return redirect()->back()->with('error', 'Error! Video not updated.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error! Something went wrong.');
        }
    }

    public function destroy($id)
    {
        $video = VideoGallery::find($id);

        if ($video) {
            $video->delete();
            return redirect()->route('backend.videogalleries.index')->with(['success' => 'Success !!VideoGallery Deleted']);
        } else {
            return redirect()->route('backend.videogalleries.index')->with('error', 'VideoGallery not found.');
        }
    }
}
