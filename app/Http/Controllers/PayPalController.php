<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Customer;

class PayPalController extends Controller
{
    public function handlePaymentSuccess(Request $request)
{
    Log::info('PayPal payment success request received', $request->all());

    try {
        $validatedData = $request->validate([
            'orderID' => 'required|string',
            'payerID' => 'required|string',
            'paymentID' => 'required|string',
            'paymentStatus' => 'required|string',
            'productId' => 'required|integer',
            'quantity' => 'required|integer',
            'totalPrice' => 'required|numeric',
        ]);

        $user = auth()->user();
        if (!$user) {
            $customer = Customer::create([
                'first_name' => 'Guest',
                'last_name' => 'User',
                'email' => 'guest_' . time() . '@example.com',
                'password' => bcrypt(Str::random(16)),
            ]);
        } else {
            $customer = $user;
        }

        $product = Product::findOrFail($validatedData['productId']);

        DB::beginTransaction();

        $order = Order::create([
            'user_id' => $customer->id,
            'order_date' => now(),
            'total_amount' => $validatedData['totalPrice'],
            'payment_method' => 'paypal',
            'payment_status' => $validatedData['paymentStatus'],
            'shipping_address' => $validatedData['shipping_address'] ?? 'Not provided',
            'shipping_country' => $validatedData['shipping_country'] ?? 'Not provided',
            'postal_code' => $validatedData['postal_code'] ?? 'Not provided',
            'shipping_cost' => 0,
            'tax_amount' => 0,
            'order_status' => 'processing',
            'is_paid' => true,
            'product_ids' => $validatedData['productId'],
            'quantities' => $validatedData['quantity'],
            'paypal_order_id' => $validatedData['orderID'],
            'paypal_payer_id' => $validatedData['payerID'],
            'paypal_payment_id' => $validatedData['paymentID'],
        ]);

        Payment::create([
            'order_id' => $order->id,
            'amount' => $validatedData['totalPrice'],
            'payment_method' => 'paypal',
            'payment_status' => $validatedData['paymentStatus'],
            'paypal_order_id' => $validatedData['orderID'],
            'paypal_payer_id' => $validatedData['payerID'],
            'paypal_payment_id' => $validatedData['paymentID'],
        ]);

        if ($product->product_quantity < $validatedData['quantity']) {
            throw new \Exception('Insufficient product quantity');
        }
        $product->product_quantity -= $validatedData['quantity'];
        $product->save();

        $order->products()->attach($product->id, ['quantity' => $validatedData['quantity']]);

        session()->forget('cart');

        DB::commit();

        Log::info('PayPal payment processed successfully', ['orderId' => $order->id]);

        return response()->json([
            'status' => 'success',
            'message' => 'Payment processed successfully',
            'redirectUrl' => route('order.summary', ['orderId' => $order->id])
        ]);

    } catch (\Exception $e) {
        DB::rollBack();
        Log::error('Error processing PayPal payment: ' . $e->getMessage(), [
            'exception' => $e,
            'trace' => $e->getTraceAsString(),
        ]);

        return response()->json([
            'status' => 'error',
            'message' => 'Error processing payment: ' . $e->getMessage()
        ], 500);
    }
}

    public function showOrderSummary($orderId)
    {
        $order = Order::findOrFail($orderId);
        $paymentMethod = $order->payment_method; 

        if ($paymentMethod === 'paypal') {
            $order = Order::with('products')->findOrFail($orderId);
            $totalPrice = 0;
            $productQuantities = [];

            foreach ($order->products as $product) {
                $quantity = $product->pivot->quantity;
                $productQuantities[$product->id] = $quantity;
                $totalPrice += $product->selling_price * $quantity;
            }
            return view('frontend.bill', [
                'order' => $order,
                'products' => $order->products,
                'totalPrice' => $totalPrice,
                'productQuantities' => $productQuantities
            ]);
        } else {
        $productIds = explode(',', $order->product_ids);
        $quantities = explode(',', $order->quantities);

        $products = Product::whereIn('id', $productIds)->get();

        $totalPrice = 0;
        foreach ($products as $index => $product) {
            $quantity = isset($quantities[$index]) ? (int) $quantities[$index] : 1;
            $totalPrice += $product->selling_price * $quantity;
        }

        return view('frontend.bill', compact('order', 'products', 'totalPrice', 'quantities'));
    }
    }


    public function handleBulkPaymentSuccess(Request $request)
{
    Log::info('PayPal bulk payment success request received', $request->all());

    try {
        $validatedData = $request->validate([
            'orderID' => 'required|string',
            'payerID' => 'required|string',
            'paymentID' => 'required|string',
            'paymentStatus' => 'required|string',
            'products' => 'required|array',
            'products.*.id' => 'required|integer|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
            'products.*.price' => 'required|numeric|min:0',
            'totalPrice' => 'required|numeric|min:0',
        ]);

        $user = auth()->user() ?? Customer::create([
            'first_name' => 'Guest',
            'last_name' => 'User',
            'email' => 'guest_' . time() . '@example.com',
            'password' => bcrypt(Str::random(16)),
        ]);

        DB::beginTransaction();

        $order = Order::create([
            'user_id' => $user->id,
            'order_date' => now(),
            'total_amount' => $validatedData['totalPrice'],
            'payment_method' => 'paypal',
            'payment_status' => $validatedData['paymentStatus'],
            'shipping_address' => $validatedData['shipping_address'] ?? 'Not provided',
            'shipping_country' => $validatedData['shipping_country'] ?? 'Not provided',
            'postal_code' => $validatedData['postal_code'] ?? 'Not provided',
            'shipping_cost' => 0,
            'tax_amount' => 0,
            'order_status' => 'processing',
            'is_paid' => true,
            'paypal_order_id' => $validatedData['orderID'],
            'paypal_payer_id' => $validatedData['payerID'],
            'paypal_payment_id' => $validatedData['paymentID'],
        ]);

        $productDetails = [];
        foreach ($validatedData['products'] as $productData) {
            $product = Product::findOrFail($productData['id']);

            if ($product->product_quantity < $productData['quantity']) {
                throw new \Exception("Insufficient quantity for product {$product->name}");
            }

            $product->product_quantity -= $productData['quantity'];
            $product->save();

            $productDetails[$product->id] = [
                'quantity' => $productData['quantity'],
            ];
        }

        $order->products()->attach($productDetails);

        Payment::create([
            'order_id' => $order->id,
            'amount' => $validatedData['totalPrice'],
            'payment_method' => 'paypal',
            'payment_status' => $validatedData['paymentStatus'],
            'paypal_order_id' => $validatedData['orderID'],
            'paypal_payer_id' => $validatedData['payerID'],
            'paypal_payment_id' => $validatedData['paymentID'],
        ]);

        DB::commit();

        Log::info('PayPal bulk payment processed successfully', ['orderId' => $order->id]);

        return response()->json([
            'status' => 'success',
            'message' => 'Bulk payment processed successfully',
            'redirectUrl' => route('bulkorder.summary', ['orderId' => $order->id])
        ]);

    } catch (\Exception $e) {
        DB::rollBack();
        Log::error('Error processing PayPal bulk payment: ' . $e->getMessage(), [
            'exception' => $e,
            'trace' => $e->getTraceAsString(),
        ]);

        return response()->json([
            'status' => 'error',
            'message' => 'Error processing bulk payment: ' . $e->getMessage()
        ], 500);
    }
}

    public function showBulkOrder($orderId)
    {
        $order = Order::findOrFail($orderId);
        $paymentMethod = $order->payment_method; 

        if ($paymentMethod === 'paypal') {
            $order = Order::with('products')->findOrFail($orderId);
            $totalPrice = 0;
            $productQuantities = [];

            foreach ($order->products as $product) {
                $quantity = $product->pivot->quantity;
                $productQuantities[$product->id] = $quantity;
                $totalPrice += $product->selling_price * $quantity;
            }
            return view('frontend.bill', [
                'order' => $order,
                'products' => $order->products,
                'totalPrice' => $totalPrice,
                'productQuantities' => $productQuantities
            ]);
        } else {
            $productIds = explode(',', $order->product_ids);
            $quantities = explode(',', $order->quantities);

            $products = Product::whereIn('id', $productIds)->get();
            $totalPrice = 0;

            foreach ($products as $index => $product) {
                $quantity = isset($quantities[$index]) ? (int) $quantities[$index] : 1;
                $totalPrice += $product->selling_price * $quantity;
            }
            return view('frontend.bill', [
                'order' => $order,
                'products' => $products,
                'totalPrice' => $totalPrice,
                'productQuantities' => array_combine($productIds, $quantities)
            ]);
        }
    }


}