@extends('frontend.layouts.master')

@section('content')
<div class="container">
    <h2>Bulk Payment</h2>
    <div id="messages">
        @if (session('success_message'))
            <div class="alert alert-success">{{ session('success_message') }}</div>
        @endif
        @if (session('error_message'))
            <div class="alert alert-danger">{{ session('error_message') }}</div>
        @endif
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div id="cart-summary">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Order Summary</h5>
                        <div class="form-group">
                            <label>Products:</label>
                            <ul class="list-group">
                                @foreach($cartData as $product)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        {{ $product['name'] }}
                                        <span class="badge bg-primary rounded-pill">{{ $product['quantity'] }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="form-group">
                            <label for="totalQuantity">Total Quantity:</label>
                            <input type="text" id="totalQuantity" class="form-control" value="{{ $totalQuantity }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="totalPrice">Total Price:</label>
                            <input type="text" id="totalPrice" class="form-control" value="Rs. {{ number_format($totalPrice, 2) }}" readonly>
                        </div>
                    </div>
                </div>
                <form action="{{ route('bulk.payment.process') }}" method="POST" id="bulk-payment-form">
                    @csrf
                    <input type="hidden" name="products" id="products-input" value="{{ json_encode($cartData) }}">
                    <input type="hidden" name="totalPrice" id="total-price-input" value="{{ $totalPrice }}">
                    
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Shipping Information</h5>
                            <div class="form-group">
                                <label for="shipping_address">Shipping Address</label>
                                <input type="text" name="shipping_address" id="shipping_address" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="shipping_country">Shipping Country</label>
                                <input type="text" name="shipping_country" id="shipping_country" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="postal_code">Postal Code</label>
                                <input type="number" name="postal_code" id="postal_code" class="form-control" min="1" required>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Payment Information</h5>
                            <div class="form-group">
                                <label for="card-element">Credit or debit card</label>
                                <div id="card-element" class="form-control">
                                    <!-- A Stripe Element will be inserted here. -->
                                </div>
                                <div id="card-errors" role="alert" class="text-danger mt-2"></div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-3">
                        <button type="submit" class="btn-sm mx-auto" style="background-color:#8B4513; color:white; border-color:#8B4513">Submit Bulk Payment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://js.stripe.com/v3/"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var stripe = Stripe('{{ env('STRIPE_KEY') }}');
        var elements = stripe.elements();
        var card = elements.create('card');

        card.mount('#card-element');

        card.addEventListener('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        var form = document.getElementById('bulk-payment-form');
        if (form) {
            form.addEventListener('submit', function(event) {
                event.preventDefault();
                stripe.createToken(card).then(function(result) {
                    if (result.error) {
                        var errorElement = document.getElementById('card-errors');
                        errorElement.textContent = result.error.message;
                    } else {
                        var hiddenInput = document.createElement('input');
                        hiddenInput.setAttribute('type', 'hidden');
                        hiddenInput.setAttribute('name', 'stripeToken');
                        hiddenInput.setAttribute('value', result.token.id);
                        form.appendChild(hiddenInput);
                        localStorage.removeItem("cart");
                        updateCartCount(); 

                        form.submit();
                    }
                });
            });
        }
    });

    function updateCartCount() {
        var cartCountElement = document.getElementById('cart-count');
        if (cartCountElement) {
            cartCountElement.textContent = '0';
        }
    }
</script>
@endsection