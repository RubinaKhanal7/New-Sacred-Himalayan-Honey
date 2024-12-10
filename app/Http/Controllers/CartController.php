<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cartItems = Cart::with(['customer', 'product'])->get();
        return view('backend.cart.index', compact('cartItems'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::all();
        $products = Product::all();
        return view('backend.cart.create', compact('products', 'customers'));
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
            'user_id' => 'required|exists:customers,id',
            'product_id' => 'required|exists:products,id',
            'product_quantity' => 'required|integer|min:1',
        ]);

        Cart::create($request->all());

        return redirect()->route('backend.carts.index')->with('success', 'Cart item created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        $customers = Customer::all();
        $products = Product::all();
        return view('backend.cart.update', compact('cart', 'customers', 'products'));
    }

    public function update(Request $request, Cart $cart)
    {
        $request->validate([
            'user_id' => 'required|exists:customers,id',
            'product_id' => 'required|exists:products,id',
            'product_quantity' => 'required|integer|min:1',
        ]);

        $cart->update($request->all());

        return redirect()->route('backend.carts.index')->with('success', 'Cart item updated successfully.');
    }
    public function destroy(Cart $cart)
    {
        $cart->delete();

        return redirect()->route('backend.carts.index')->with('success', 'Cart item deleted successfully.');
    }
}
