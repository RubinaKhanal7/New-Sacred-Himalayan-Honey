<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Models\Category;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::all();
        return view('backend.brand.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('backend.brand.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'brand_name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
        ]);

        Brand::create($request->all());

        return redirect()->route('backend.brands.index')
                         ->with('success', 'Brand created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brand = Brand::findOrFail($id);
        $categories = Category::all(); // Fetch all categories
        return view('backend.brand.update', compact('brand', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'brand_name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
        ]);

        $brand = Brand::findOrFail($id);
        $brand->update($request->all());

        return redirect()->route('backend.brands.index')
                         ->with('success', 'Brand updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getBrandsByCategory($category_id)
    {
        $brands = Brand::where('category_id', $category_id)->get();
        return response()->json($brands);
    }




    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);
        $brand->delete();

        return redirect()->route('backend.brands.index')
                         ->with('success', 'Brand deleted successfully.');
    }
}
