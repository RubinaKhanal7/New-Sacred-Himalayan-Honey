<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    /**
     * Display a listing of the wishlist items.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
{
    // Retrieve all wishlist items
    $wishlists = Wishlist::with(['user', 'product'])->get();
    
    // Return a view with the wishlist items data
    return view('backend.wishlist.index', compact('wishlists'));
}


    /**
     * Show the form for creating a new wishlist item.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Retrieve all users and products
        $users = User::all();
        $products = Product::all();
        
        // Return a view for creating a new wishlist item with users and products
        return view('backend.wishlist.create', compact('users', 'products'));
    }

    /**
     * Store a newly created wishlist item in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
            'product_name' => 'required|string',
        ]);

        // Create a new wishlist item
        Wishlist::create($validatedData);

        // Redirect to the wishlist index or do something else
        return redirect()->route('backend.wishlists.index')->with('success', 'Wishlist item created successfully.');
    }

    /**
     * Show the form for editing the specified wishlist item.
     *
     * @param  \App\Models\Wishlist  $wishlistItem
     * @return \Illuminate\Http\Response
     */
    public function edit(Wishlist $wishlistItem)
{
    // Retrieve all users and products
    $users = User::all();
    $products = Product::all();
    
    // Return a view for editing the specified wishlist item with users and products
    return view('backend.wishlist.update', compact('wishlistItem', 'users', 'products'));
}


    /**
     * Update the specified wishlist item in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Wishlist  $wishlistItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Wishlist $wishlistItem)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
            'product_name' => 'required|string',
        ]);

        // Update the wishlist item
        $wishlistItem->update($validatedData);

        // Redirect to the wishlist index or do something else
        return redirect()->route('wishlists.index')->with('success', 'Wishlist item updated successfully.');
    }

    /**
     * Remove the specified wishlist item from storage.
     *
     * @param  \App\Models\Wishlist  $wishlistItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(Wishlist $wishlistItem)
    {
        // Delete the wishlist item
        $wishlistItem->delete();

        // Redirect to the wishlist index or do something else
        return redirect()->route('backend.wishlists.index')->with('success', 'Wishlist item deleted successfully.');
    }
}
