<?php

namespace App\Http\Controllers;

use App\Models\Whyus;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SummernoteContent;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Log;

class WhyusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $whyus = Whyus::paginate(10);
        // $summernoteContent = new SummernoteContent();
        return view('backend.whyus.index', ['whyus' => $whyus,'page_title' => 'Why Us']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $summernoteContent = new SummernoteContent();
        return view('backend.whyus.create', ['page_title' => 'Create Why Us']);
    }

    /**
     * Store a newly created resource in storage.
     */
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
        $request->image->move(public_path('uploads/whyus'), $newImageName);

        // $summernoteContent = new SummernoteContent();
        // $processedContent = $summernoteContent->processContent($request->input('content'));

        $whyus = new Whyus;
        $whyus->title = $request->title;
        $whyus->subtitle = $request->subtitle ?? '';
        $whyus->description = $request->description;
        $whyus->slug = SlugService::createSlug(Whyus::class, 'slug', $request->title);
        $whyus->image = $newImageName;
        $whyus->content = $request->content;
        // $whyus->content = $processedContent;

        if ($whyus->save()) {
            return redirect()->route('backend.whyus.index')->with('success', 'Success! Why us created.');
        } else {
            return redirect()->back()->with('error', 'Error! Why us not created.');
        }
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Error! Something went wrong.');
    }
    }

    /**
     * Display the specified resource.
     */
    public function show(Whyus $whyus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $whyus = Whyus::find($id);
        return view('backend.whyus.update', ['whyus' => $whyus, 'page_title' => 'Update Why Us']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string',
            'subtitle' => 'nullable|string',
            'description' => 'required|string',
            'image' => 'sometimes|image|mimes:jpg,png,jpeg,gif,svg|max:1536',
            'content' => 'required|string',
        ]);

        try {
            $whyus = Whyus::findOrFail($id);

            if ($request->hasFile('image')) {
                // Delete the old image from the server
                if ($whyus->image && file_exists(public_path('uploads/whyus/' . $whyus->image))) {
                    unlink(public_path('uploads/whyus/' . $whyus->image));
                }

                // Upload the new image
                $newImageName = time() . '-' . $request->image->getClientOriginalName();
                $request->image->move(public_path('uploads/whyus'), $newImageName);
                $whyus->image = $newImageName;
            }

            // $summernoteContent = new SummernoteContent();
            // $processedContent = $summernoteContent->processContent($request->input('content'));


            // Update the model properties
            $whyus->title = $request->title;
            $whyus->subtitle = $request->subtitle ?? '';
            $whyus->description = $request->description;
            $whyus->slug = SlugService::createSlug(Whyus::class, 'slug', $request->title);
            $whyus->content = $request->content;
            // $whyus->content =$processedContent;

            // Save the updated model
            $whyus->save();

            return redirect()->route('backend.whyus.index')->with('success', 'Success !! whyus Updated');
        } catch (\Exception $e) {
            // Optionally log the error
            Log::error('Why US update failed: ' . $e->getMessage());

            return redirect()->back()->withInput()->with('error', 'Error !! Something went wrong. ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $whyus = Whyus::find($id);

        if ($whyus) {
            $whyus->delete();
            return redirect()->route('backend.whyus.index')->with('success', 'Success !! why us Deleted');
        } else {
            return redirect()->route('backend.whyus.index')->with('error', 'why us not found.');
        }
    }
}
