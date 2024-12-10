
@extends('frontend.layouts.master')

@section('content')
<div class="profile-container">
    <h1 class="profile-title" style="text-align: left; margin-left: 0;">Profile</h1>
    <div class="honeycomb-layout">
        <section class="honeycomb-cell order-details">
            <h2>Your Orders</h2>
            @if($orders && $orders->count() > 0)
                @foreach($orders as $order)
                    <div class="order-card">
                        <p><strong>Order ID:</strong> {{ $order->id }}</p>
                        <p><strong>User:</strong> {{ $order->user->name }}</p>
                        <p><strong>Quantity Ordered:</strong> {{ $order->quantity }}</p>
                        <p><strong>Total Amount:</strong> ${{ number_format($order->total_price, 2) }}</p>
                    </div>
                @endforeach
            @else
                <p class="no-data">No orders found.</p>
            @endif
        </section>
        
        <section class="honeycomb-cell payment-details">
            <h2>Your Payments</h2>
            @if($payments && $payments->count() > 0)
                @foreach($payments as $payment)
                    <div class="payment-card">
                        <p><strong>Payment ID:</strong> {{ $payment->id }}</p>
                        <p><strong>Order ID:</strong> {{ $payment->order_id }}</p>
                        <p><strong>Amount:</strong> ${{ number_format($payment->amount, 2) }}</p>
                        <p><strong>Method:</strong> {{ ucfirst($payment->payment_method) }}</p>
                        <p><strong>Status:</strong> <span class="status-{{ strtolower($payment->payment_status) }}">{{ ucfirst($payment->payment_status) }}</span></p>
                    </div>
                @endforeach
            @else
                <p class="no-data">No payments found.</p>
            @endif
        </section>
        <section class="honeycomb-cell change-password">
            <h2>Change Password</h2>
            <form action="{{ route('password.change') }}" method="post">
                @csrf
                <div class="form-groups">
                    <label for="current_password">Current Password</label>
                    <input type="password" name="current_password" id="current_password" required>
                    @error('current_password')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-groups">
                    <label for="new_password">New Password</label>
                    <input type="password" name="new_password" id="new_password" required>
                    @error('new_password')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-groups">
                    <label for="new_password_confirmation">Confirm New Password</label>
                    <input type="password" name="new_password_confirmation" id="new_password_confirmation" required>
                    @error('new_password_confirmation')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn-honey">Change Password</button>
            </form>
        </section>
    </div>
</div>
@endsection