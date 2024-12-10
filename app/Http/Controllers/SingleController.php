<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\SiteSetting;
use App\Models\BlogPostsCategory;
use App\Models\About;
use App\Models\Whyus;
use App\Models\PhotoGallery;
use App\Models\VideoGallery;
use App\Models\Category;

class SingleController extends Controller
{
    public function render_products()
{
    $products = Product::latest()->get();
    $categories = Category::with('products')->get();
    return view('frontend.product', compact('products','categories'));
}

public function render_contact()
    {
        $page_title = 'Contact Us';
        $googleMapsLink = Sitesetting::first()->google_maps_link;
        return view('frontend.contact', compact('page_title', 'googleMapsLink'));
    }

    public function render_blogpostcategory()
    {
        $blogpostcategories = BlogPostsCategory::all();

        return view('frontend.blog', compact('blogpostcategories'));
    }

    public function render_blogdetail($slug)
    {
        $blogpostcategory = BlogPostsCategory::where('slug', $slug)->firstOrFail();
        return view('frontend.blogpagedetail', compact('blogpostcategory'));
    }

    public function render_aboutus()
    {
        $about = About::all();
         $whyus = Whyus::all();
        return view('frontend.about', compact('about','whyus'));
    }


    public function render_photogallery()
    {
        $images = PhotoGallery::all();
        return view('frontend.imagegallery', compact('images'));
    }

    public function render_videogallery()
    {
        $videos = VideoGallery::all();
        return view('frontend.videogalley', compact('videos'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        
        if ($query) {
            $categories = Category::with('products')->get();
            $products = Product::where('product_name', 'LIKE', "%{$query}%")->get();
        } else {
            $categories = Category::with('products')->get();
            $products = Product::all();
        }
        return view('frontend.product', compact('categories', 'products'));
    }
    

public function searchBlog(Request $request)
{
    $query = $request->input('query');
    
    if ($query) {
        $blogpostcategories = BlogPostsCategory::where('title', 'LIKE', "%{$query}%")
            ->orWhere('content', 'LIKE', "%{$query}%")
            ->get();
    } else {
        $blogpostcategories = BlogPostsCategory::all();
    }

    return view('frontend.blog', compact('blogpostcategories'));
}

public function render_catalog()
{
    $catalog = Product::all();
    return view('frontend.catalog', compact('catalog'));
}

public function render_bill()
{
    $bill = Product::all();
    return view('frontend.bill', compact('bill'));
}

}
