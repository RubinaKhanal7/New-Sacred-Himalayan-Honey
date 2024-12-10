<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\ImageCompressor;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the products.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Retrieve all products
        $products = Product::all();

        // Return a view with the products data
        return view('backend.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new product.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Return a view for creating a new product
        $brands = Brand::all();
        $categories = Category::all();
        return view('backend.product.create', compact('categories', 'brands'));
    }

    /**
     * Store a newly created product in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   
     public function store(Request $request)
     {
         try {
             // Validate form data
             $request->validate([
                 'product_name' => 'required|string',
                 'description' => 'required|string',
                 'cost_price' => 'required|numeric',
                 'selling_price' => 'required|numeric',
                 'product_quantity' => 'required|numeric',
                 'category_id' => 'required|exists:categories,id',
                 'brand_id' => 'required|exists:brands,id',
                 'material' => 'nullable|string',
                 'product_image' => 'required|image|max:2048',
                 'other_images' => 'nullable|array',
                 'other_images.*' => 'nullable|image|max:2048',
                 'status' => 'required|string|in:active,inactive',
             ]);
     
             // Log the incoming request data for debugging
             Log::info('Incoming Request Data: ', $request->all());
     
             // Create directory for the product if it doesn't exist
             $productName = Str::slug($request->product_name);
     
             // Save the product image
             $productImagePath = ImageCompressor::compressAndSave($request, $productName, 'product_image');
     
             // Save other images
             $otherImages = [];
             if ($request->hasFile('other_images')) {
                 foreach ($request->file('other_images') as $otherImage) {
                     $otherImagePath = ImageCompressor::compressAndSave($otherImage, $productName);
                     $otherImages[] = $otherImagePath;
                 }
             }
     
             // Create a new product
             $product = new Product();
             $product->product_name = $request->product_name;
             $product->description = $request->description;
             $product->cost_price = $request->cost_price;
             $product->selling_price = $request->selling_price;
             $product->product_quantity = $request->product_quantity;
             $product->category_id = $request->category_id;
             $product->brand_id = $request->brand_id;
             $product->material = $request->material;
             $product->product_image = $productImagePath;
             $product->other_images = json_encode($otherImages);
             $product->status = $request->status;
             $product->save();
     
             // Redirect to the products index with a success message
             return redirect()->route('backend.products.index')->with('success', 'Product created successfully.');
         } catch (\Exception $e) {
             // Log the exception for debugging
             Log::error('Error creating product: ' . $e->getMessage());
             // Return error message
             return redirect()->back()->with('error', 'An error occurred while creating the product: ' . $e->getMessage());
         }
     }
     
     public function show($id)
     {
         $product = Product::findOrFail($id);
         $quantity = request('quantity', 1);
         $totalPrice = request('totalPrice', $product->selling_price * $quantity);
 
         return view('frontend.productcategories.itemsdetail', compact('product', 'quantity', 'totalPrice'));
     }
 
     public function checkAuth()
     {
         return response()->json(['authenticated' => Auth::check()]);
     }
 
     public function payment($id)
     {
         $product = Product::findOrFail($id);
         $quantity = request('quantity', 1);
         $totalPrice = request('totalPrice', $product->selling_price * $quantity);
 
         if (!Auth::check()) {
             return redirect()->route('login');
         }
 
         // Here you would typically process the payment or show a payment form
         // For now, we'll just return a view
         return view('payment', compact('product', 'quantity', 'totalPrice'));
     }
     
     public function buyNow($id)
     {
         $product = Product::findOrFail($id);
         $quantity = request('quantity', 1);
         $totalPrice = request('totalPrice', $product->selling_price * $quantity);
     
         if (!Auth::check()) {
             // Store the product details in the session
             session([
                 'buy_now_product_id' => $id,
                 'buy_now_quantity' => $quantity,
                 'buy_now_total_price' => $totalPrice
             ]);
     
             // Redirect to login page
             return redirect()->route('login')->with('message', 'Please log in to complete your purchase.');
         }
     
         // User is logged in, proceed to payment page
         return redirect()->route('payment.show', [
             'productId' => $id,
             'quantity' => $quantity,
             'totalPrice' => $totalPrice
         ]);
     }
     

    /**
     * Show the form for editing the specified product.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        // Return a view for editing the specified product
        $categories = Category::all();
        $brands = Brand::all();

        return view('backend.product.update', compact('product', 'categories', 'brands'));
    }

    /**
     * Update the specified product in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
{
    try {
        // Validate the incoming request
        $request->validate([
            'product_name' => 'required|string',
            'description' => 'nullable|string',
            'cost_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'product_quantity' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'material' => 'nullable|string',
            'product_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'other_images' => 'nullable|array',
            'other_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|string|in:active,inactive',
        ]);

        // Log the incoming request data for debugging
        Log::info('Incoming Request Data for Update: ', $request->all());

        // Create directory for the product if it doesn't exist
        $productName = Str::slug($request->product_name);

        // Handle product image upload and compression
        if ($request->hasFile('product_image')) {
            $productImagePath = ImageCompressor::compressAndSave($request, $productName, 'product_image');
            $product->product_image = $productImagePath;
        }

        // Handle multiple other images upload and compression
        $otherImages = [];
        if ($request->hasFile('other_images')) {
            foreach ($request->file('other_images') as $otherImage) {
                $otherImagePath = ImageCompressor::compressAndSave($otherImage, $productName);
                $otherImages[] = $otherImagePath;
            }
            $product->other_images = json_encode($otherImages);
        }

        // Update the product
        $product->product_name = $request->product_name;
        $product->description = $request->description;
        $product->cost_price = $request->cost_price;
        $product->selling_price = $request->selling_price;
        $product->product_quantity = $request->product_quantity;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->material = $request->material;
        $product->status = $request->status;
        $product->save();

        // Redirect to the products index with a success message
        return redirect()->route('backend.products.index')
                         ->with('success', 'Product updated successfully.');
    } catch (ValidationException $e) {
        // If validation fails, redirect back with errors
        return redirect()->back()->withErrors($e->validator->errors())->withInput();
    } catch (\Exception $e) {
        // Log the exception for debugging
        Log::error('Error updating product: ' . $e->getMessage());

        // Return error message
        return redirect()->back()->with('error', 'An error occurred while updating the product: ' . $e->getMessage());
    }
}



    /**
     * Remove the specified product from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        // Delete the product
        $product->delete();

        // Redirect to the products index with a success message
        return redirect()->route('backend.products.index')
                         ->with('success', 'Product deleted successfully.');
    }

    public function getBrands($categoryId)
    {
        $brands = Brand::where('category_id', $categoryId)->get();
        return response()->json($brands);
    }

    public function addToCart($id)
{
    if (!Auth::check()) {
        // User is not logged in, redirect to login page with a message
        return redirect()->route('login')->with('message', 'Please log in to add items to your cart.');
    }
    
    // User is logged in, proceed with adding to cart
    return redirect()->route('show', ['id' => $id]);
}


}
