<?php

namespace App\Http\Controllers;

use App\Models\OrderWithoutLogin;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrderWithoutLoginController extends Controller
{
    /**
     * Display a listing of the orders without login.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ordersWithoutLogin = OrderWithoutLogin::latest();
        return view('backend.order.index', compact('ordersWithoutLogin'));
    }

    /**
     * Show the form for creating a new order.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        return view('backend.orderwithoutlogin.create', compact('products'));
    }

    /**
     * Store a newly created order in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_name' => 'required|string|max:255',
            'user_email' => 'required|email|max:255',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|numeric|min:1',
            'total_amount' => 'required|numeric|min:0',
            'shipping_address' => 'required|string|max:255',
            'shipping_country' => 'required|string|max:255',
            'postal_code' => 'required|string|max:20',
            'payment_method' => 'required|string|max:255',
            'payment_status' => 'required|string|in:pending,completed,cancelled',
            'order_status' => 'required|string|in:pending,processing,shipped,delivered,cancelled',
            'is_paid' => 'required|boolean',
            'is_shipped' => 'required|boolean',
            'is_delivered' => 'required|boolean',
            'delivery_date' => 'nullable|date',
            'delivery_time' => 'nullable|string|max:5',
        ]);

        OrderWithoutLogin::create($validatedData);
        return redirect()->route('backend.orderswithoutlogin.index');
    }

    /**
     * Show the form for editing the specified order.
     *
     * @param  \App\Models\OrderWithoutLogin  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderWithoutLogin $order)
    {
        $products = Product::all();
        return view('backend.orderwithoutlogin.update', compact('order', 'products'));
    }

    /**
     * Update the specified order in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrderWithoutLogin  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderWithoutLogin $order)
    {
        $validatedData = $request->validate([
            'user_name' => 'required|string|max:255',
            'user_email' => 'required|email|max:255',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|numeric|min:1',
            'total_amount' => 'required|numeric|min:0',
            'shipping_address' => 'required|string|max:255',
            'shipping_country' => 'required|string|max:255',
            'postal_code' => 'required|string|max:20',
            'payment_method' => 'required|string|max:255',
            'payment_status' => 'required|string|in:pending,completed,cancelled',
            'order_status' => 'required|string|in:pending,processing,shipped,delivered,cancelled',
            'is_paid' => 'required|boolean',
            'is_shipped' => 'required|boolean',
            'is_delivered' => 'required|boolean',
            'delivery_date' => 'nullable|date',
            'delivery_time' => 'nullable|string|max:5',
        ]);

        $order->update($validatedData);
        return redirect()->route('backend.orderswithoutlogin.index');
    }

    /**
     * Remove the specified order from storage.
     *
     * @param  \App\Models\OrderWithoutLogin  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderWithoutLogin $order)
    {
        Log::info('Destroy method called for order: ' . $order->id);
        try {
            $order->delete();
            return redirect()->route('backend.orderswithoutlogin.index')->with('success', 'Order deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Error deleting order: ' . $e->getMessage());
            return redirect()->route('backend.orderswithoutlogin.index')->with('error', 'Failed to delete order.');
        }
    }
}
