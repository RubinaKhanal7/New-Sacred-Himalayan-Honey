<?php

namespace App\Http\Controllers;


use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {

        $testimonials = Testimonial::latest()->paginate(10);

        return view('backend.testimonial.index', ['testimonials' => $testimonials, 'page_title' => 'Testimonials']);
    }

    public function create()
    {
        return view('backend.testimonial.create', ['page_title' => 'Add Testimonial']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,avif,webp,avi|max:2048',
            'description' => 'required|string',
        ]);

        try {
            $newImageName = time() . '-' . $request->image->getClientOriginalName();
            $request->image->move(public_path('uploads/testimonial'), $newImageName);

            $testimonial = new Testimonial();
            $testimonial->name = $request->name;
            $testimonial->image = $newImageName;
            $testimonial->description= $request->description;

            $testimonial->save();
            return redirect()->route('backend.testimonials.index')->with('success', 'Testimonial created successfully.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'An error occurred while creating testimonial: ' . $e->getMessage());
        }
    }

    // Inside TestimonialController

    public function edit($id)
    {
        $testimonials = Testimonial::find($id);
        if (!$testimonials) {
            return redirect()->route('backend.testimonials.index')->with('error', 'Testimonial not found.');
        }
        return view('backend.testimonial.update', [
            'testimonials' => $testimonials,
            'page_title' => 'Update Testimonial'
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,avif,webp|nullable|max:2048',
            'description' => 'required|string',
        ]);

        try {
            $testimonial = Testimonial::find($id);
            if (!$testimonial) {
                return back()->with('error', 'Testimonial not found.');
            }

            // Check if a new image is uploaded
            if ($request->hasFile('image')) {
                // Delete the old image from the server if it exists
                if ($testimonial->image && file_exists(public_path('uploads/testimonial/' . $testimonial->image))) {
                    unlink(public_path('uploads/testimonial/' . $testimonial->image));
                }

                // Upload the new image
                $newImageName = time() . '-' . $request->image->getClientOriginalName();
                $request->image->move(public_path('uploads/testimonial'), $newImageName);
                $testimonial->image = $newImageName;
            }

            // Update the testimonial with the new data
            $testimonial->name = $request->name;
            $testimonial->description = $request->description;
            $testimonial->save();

            return redirect()->route('backend.testimonials.index')->with('success', 'Testimonial updated successfully.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'An error occurred while updating the Testimonial: ' . $e->getMessage());
        }
    }


    public function destroy($id)
    {
        try {
            $testimonials = Testimonial::find($id);
            if (!$testimonials) {
                return back()->with('error', 'Testimonial not found.');
            }

            $testimonials->delete();
            return redirect()->route('backend.testimonials.index')->with('success', 'Testimonial deleted successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred while deleting Testimonial: ' . $e->getMessage());
        }
    }



}
