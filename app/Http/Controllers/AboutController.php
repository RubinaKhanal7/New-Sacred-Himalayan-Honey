<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Services\SlugService;
use App\Models\SummernoteContent;
use Illuminate\Support\Facades\Log;


class AboutController extends Controller
{
    public function index()
    {
        $abouts = About::paginate(10);
        $summernoteContent = new SummernoteContent();
        return view('backend.about.index', ['abouts' => $abouts, 'summernoteContent' => $summernoteContent, 'page_title' => 'About Us']);


    }
    public function create()
    {
        $summernoteContent = new SummernoteContent();
        return view('backend.about.create', ['page_title' => 'Create About Us', 'summernoteContent' => $summernoteContent]);

    }
    public function store(Request $request)
    {
            $request->validate([
                'title' => 'required|string',
                'subtitle' => 'nullable|string',
                'description' => 'required|string',
                'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:1536',
                'content' => 'required|string',
            ]);
            try {
            $newImageName = time() . '-' . $request->image->getClientOriginalName();
            $request->image->move(public_path('uploads/about'), $newImageName);

            $summernoteContent = new SummernoteContent();
            $processedContent = $summernoteContent->processContent($request->input('content'));

            $about = new About;
            $about->title = $request->title;
            $about->subtitle = $request->subtitle ?? '';
            $about->description = $request->description;
            $about->slug = SlugService::createSlug(About::class, 'slug', $request->title);
            $about->image = $newImageName;
            $about->content = $processedContent;

            if ($about->save()) {
                return redirect()->route('backend.aboutus.index')->with('success', 'Success! About us created.');
            } else {
                return redirect()->back()->with('error', 'Error! About us not created.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error! Something went wrong.');
        }
    }
    public function edit($id)
    {
        $about = About::find($id);
        return view('backend.about.update', ['about' => $about, 'page_title' => 'Update About Us']);

    }
    public function update(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'title' => 'required|string',
            'subtitle' => 'nullable|string',
            'description' => 'required|string',
            'image' => 'sometimes|image|mimes:jpg,png,jpeg,gif,svg|max:1536',
            'content' => 'required|string',
        ]);

        try {
            $about = About::findOrFail($id);

            if ($request->hasFile('image')) {
                // Delete the old image from the server
                if ($about->image && file_exists(public_path('uploads/about/' . $about->image))) {
                    unlink(public_path('uploads/about/' . $about->image));
                }

                // Upload the new image
                $newImageName = time() . '-' . $request->image->getClientOriginalName();
                $request->image->move(public_path('uploads/about'), $newImageName);
                $about->image = $newImageName;
            }

            $summernoteContent = new SummernoteContent();
            $processedContent = $summernoteContent->processContent($request->input('content'));


            // Update the model properties
            $about->title = $request->title;
            $about->subtitle = $request->subtitle ?? '';
            $about->description = $request->description;
            $about->slug = SlugService::createSlug(About::class, 'slug', $request->title);
            $about->content =$processedContent;

            // Save the updated model
            $about->save();

            return redirect()->route('backend.aboutus.index')->with('success', 'Success !! About Updated');
        } catch (\Exception $e) {
            // Optionally log the error
            Log::error('About update failed: ' . $e->getMessage());

            return redirect()->back()->withInput()->with('error', 'Error !! Something went wrong. ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $about = About::find($id);

        if ($about) {
            $about->delete();
            return redirect()->route('backend.aboutus.index')->with('success', 'Success !! About us Deleted');
        } else {
            return redirect()->route('backend.aboutus.index')->with('error', 'About us not found.');
        }
    }
}