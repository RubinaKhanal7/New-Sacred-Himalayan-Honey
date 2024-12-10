<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(Request $request): View
    {
        if ($request->has('cart_data')) {
            $cartData = json_decode(urldecode($request->input('cart_data')), true);
            $request->session()->put('cart_data', $cartData);
        }
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse|JsonResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'redirect' => $request->input('redirect', route('dashboard')),
            ]);
        }

        return redirect($request->input('redirect', route('dashboard')));
    }

private function getRedirectUrl()
{
    if (session()->has('buy_now_product_id')) {
        $productId = session('buy_now_product_id');
        $quantity = session('buy_now_quantity');
        $totalPrice = session('buy_now_total_price');

        // Clear the session data
        session()->forget(['buy_now_product_id', 'buy_now_quantity', 'buy_now_total_price']);

        return route('payment.show', [
            'productId' => $productId,
            'quantity' => $quantity,
            'totalPrice' => $totalPrice
        ]);
    }

    return route('dashboard');
}

protected function authenticated(Request $request, $user)
{
    if ($request->session()->has('cart_data')) {
        $cartData = $request->session()->get('cart_data');
        $request->session()->forget('cart_data');

        $request->session()->put('cart_data', $cartData); 

        return redirect()->route('bulk.payment', [
            'products' => json_encode($cartData['products']),
            'totalQuantity' => $cartData['totalQuantity'],
            'totalPrice' => $cartData['totalPrice']
        ]);
    }

    return redirect()->intended('/');
}

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}