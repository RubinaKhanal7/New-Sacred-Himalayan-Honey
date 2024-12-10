<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Customer;
use App\Models\PaymentWithoutLogin;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    /**
     * Display a listing of the payments.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = Payment::all();
        $paymentsWithoutLogin = PaymentWithoutLogin::all();
        $allPayments = $payments->concat($paymentsWithoutLogin);

        $allPayments = $allPayments->sortByDesc('id');
        
        return view('backend.payment.index', ['payments' => $allPayments]);
    }
    /**
     * Show the form for creating a new payment.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $orders = Order::all();
        return view('backend.payment.create', compact('orders'));
    }

    /**
     * Store a newly created payment in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|string',
            'payment_status' => 'required|string',
        ]);

        // Create a new payment
        $payment = Payment::create($validatedData);

        // Redirect to the payments index or do something else
        return redirect()->route('backend.payments.index');
    }


    /**
     * Show the form for editing the specified payment.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        // Return a view for editing the specified payment
        return view('backend.payment.update', ['payment' => $payment]);
    }

    /**
     * Update the specified payment in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {

        $validatedData = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|string',
            'payment_status' => 'required|string',
        ]);

        $payment->update($validatedData);
        return redirect()->route('backend.payments.index');
    }

    /**
     * Remove the specified payment from storage.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $payment = Payment::find($id);
            if (!$payment) {
                $payment = PaymentWithoutLogin::find($id);
            }

            if (!$payment) {
                return redirect()->route('backend.payments.index')->with('error', 'Payment not found.');
            }

            $payment->delete();
            return redirect()->route('backend.payments.index')->with('success', 'Payment deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('backend.payments.index')->with('error', 'Failed to delete payment.');
        }
    }

    public function show($productId)
    {
        $product = Product::findOrFail($productId);
        $quantity = (int) request('quantity', 1);
        $totalPrice = $product->selling_price * $quantity;
        return view('frontend.payment', [
            'product' => $product,
            'quantity' => $quantity,
            'totalPrice' => $totalPrice
        ]);
    }

    public function process(Request $request)
{
    Stripe::setApiKey(env('STRIPE_SECRET'));

    try {
        $charge = Charge::create([
            'amount' => $request->amount * 100,
            'currency' => 'usd',
            'source' => $request->stripeToken,
            'description' => 'Payment for order',
        ]);

        $user = auth()->user();
        if (!$user) {
            return back()->with('error_message', 'User not authenticated');
        }

        $customer = Customer::where('email', $user->email)->firstOrCreate(
            ['email' => $user->email],
            [
                'first_name' => $user->name,
                'password' => bcrypt('temporary_password'),
            ]
        );

        $productId = $request->product_id;
        $quantity = $request->quantity;

        $order = new Order([
            'user_id' => $customer->id,
            'order_date' => now(),
            'total_amount' => $request->amount,
            'payment_method' => 'stripe',
            'payment_status' => 'completed',
            'shipping_address' => $request->shipping_address,
            'shipping_country' => $request->shipping_country,
            'postal_code' => $request->postal_code,
            'shipping_cost' => 0,
            'tax_amount' => 0,
            'order_status' => 'pending',
            'is_paid' => true,
            'product_ids' => $productId,
            'quantities' => $quantity,
        ]);

        if (!$order->save()) {
            throw new \Exception('Failed to save order');
        }

        $payment = new Payment([
            'order_id' => $order->id,
            'amount' => $request->amount,
            'payment_method' => 'stripe',
            'payment_status' => 'completed',
        ]);

        if (!$payment->save()) {
            throw new \Exception('Failed to save payment');
        }
        session()->forget('cart');

        session()->flash('payment_success', true);
        return redirect()->route('Bill', $order->id)->with('success_message', 'Payment successful! Your cart has been cleared.');
    } catch (\Exception $e) {
        Log::error('Payment processing error: ' . $e->getMessage());
        return back()->with('error_message', 'Error! ' . $e->getMessage());
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
        $productQuantities = [];

        foreach ($products as $index => $product) {
            $quantity = isset($quantities[$index]) ? (int) $quantities[$index] : 1;
            $productQuantities[$product->id] = $quantity;
            $totalPrice += $product->selling_price * $quantity;
        }

        return view('frontend.bill', [
            'order' => $order,
            'products' => $products,
            'totalPrice' => $totalPrice,
            'productQuantities' => $productQuantities
        ]);
    }
}
}
