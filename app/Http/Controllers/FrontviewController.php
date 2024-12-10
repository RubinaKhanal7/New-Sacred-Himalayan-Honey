<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\BlogPostsCategory;
use App\Models\About;
use App\Models\Whyus;
use App\Models\Sitesetting;
use App\Models\CoverImage;
use App\Models\Testimonial;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Customer;
use App\Models\Category;
use Stripe\Stripe;
use Stripe\Charge;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class FrontviewController extends Controller
{
    public function index()
    {
        $sitesetting = Sitesetting::first();
        $products = Product::where('status', 'active')->get();
        $blogpostcategories = BlogPostsCategory::latest()->take(3)->get();
        $about = About::latest()->take(3)->get();
        $whyus = Whyus::latest()->take(3)->get();
        $coverimages = CoverImage::all();
        $categories = Category::with('products')->get();
        $testimonials = Testimonial::latest()->get()->take(10);

        return view('frontend.index', compact('products', 'blogpostcategories', 'about', 'whyus', 'coverimages', 'testimonials', 'categories'));
    }
    public function userIndex()
    {
        $user = Auth::user();
        $sitesetting = Sitesetting::first();
        $products = Product::where('status', 'active')->get();
        $blogpostcategories = BlogPostsCategory::latest()->take(3)->get();
        $about = About::latest()->take(3)->get();
        $whyus = Whyus::latest()->take(3)->get();
        $coverimages = CoverImage::all();
        $categories = Category::with('products')->get();
        $testimonials = Testimonial::latest()->get()->take(10);

        $userOrders = Order::where('user_id', $user->id)->latest()->get();
        $userPayments = Payment::whereIn('order_id', $userOrders->pluck('id'))->get();

        return view('dashboard', compact(
            'user',
            'sitesetting',
            'products',
            'blogpostcategories',
            'about',
            'whyus',
            'coverimages',
            'testimonials',
            'userOrders',
            'userPayments',
            'categories',
        ));
    }

    public function bulkPayment(Request $request)
    {
        $cartData = json_decode($request->query('products'), true) ?? [];
        $totalQuantity = intval($request->query('totalQuantity', 0));
        $totalPrice = floatval($request->query('totalPrice', 0));

        Log::info('Bulk Payment Request', [
            'products' => $request->query('products'),
            'totalQuantity' => $request->query('totalQuantity'),
            'totalPrice' => $request->query('totalPrice'),
            'all' => $request->all(),
        ]);

        if (empty($cartData)) {
            $sessionCartData = $request->session()->get('cart_data');
            if ($sessionCartData) {
                $cartData = $sessionCartData['products'] ?? [];
                $totalQuantity = $sessionCartData['totalQuantity'] ?? 0;
                $totalPrice = $sessionCartData['totalPrice'] ?? 0;
            }
        }

        return view('frontend.bulkpayment', compact('cartData', 'totalQuantity', 'totalPrice'));
    }

  public function processBulkPayment(Request $request)
{
    if (!Auth::check()) {
        return redirect()->route('login')->with('error_message', 'Please log in to continue bulk payment.');
    }

    try {
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $user = Auth::user();
        $customer = Customer::firstOrCreate(
            ['email' => $user->email],
            [
                'first_name' => $user->name,
                'password' => bcrypt('temporary_password'),
            ]
        );

        $products = json_decode($request->input('products'), true);
        $totalPrice = $request->input('totalPrice');

        $charge = Charge::create([
            'amount' => $totalPrice * 100, 
            'currency' => 'usd',
            'source' => $request->stripeToken,
            'description' => 'Bulk Order Payment',
        ]);

        $productIds = [];
        $quantities = [];
        foreach ($products as $product) {
            $productIds[] = $product['id'];
            $quantities[] = $product['quantity'];
        }
        $order = Order::create([
            'user_id' => $customer->id,
            'order_date' => now(),
            'total_amount' => $totalPrice,
            'payment_method' => 'stripe',
            'payment_status' => 'completed',
            'shipping_address' => $request->shipping_address,
            'shipping_country' => $request->shipping_country,
            'postal_code' => $request->postal_code,
            'shipping_cost' => 0,
            'tax_amount' => 0,
            'order_status' => 'pending',
            'is_paid' => true,
            'product_ids' => implode(',', $productIds), 
            'quantities' => implode(',', $quantities),  
        ]);

        Payment::create([
            'order_id' => $order->id,
            'amount' => $totalPrice,
            'payment_method' => 'stripe',
            'payment_status' => 'completed',
        ]);

        session()->flash('payment_success', true);
        return redirect()->route('BulkBill', $order->id)->with('success_message', 'Bulk payment successful!');
    } catch (\Exception $e) {
        return back()->with('error_message', 'Error! ' . $e->getMessage());
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

    public function showNewPaymentPage($productId, Request $request)
    {
        $product = Product::findOrFail($productId);
        $quantity = $request->query('quantity', 1);
        $totalPrice = $request->query('totalPrice', $product->selling_price * $quantity);

        return view('frontend.newpayment', [
            'product' => $product,
            'quantity' => $quantity,
            'totalPrice' => $totalPrice
        ]);
    }

}
