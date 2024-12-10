@extends('frontend.layouts.master')

@section('content')
<div class="container">
    @if (session('success_message'))
        <div class="alert alert-success">{{ session('success_message') }}</div>
    @endif

    @if (session('error_message'))
        <div class="alert alert-danger">{{ session('error_message') }}</div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="{{ route('payment.process_without_login') }}" method="POST" id="payment-form">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="card-element">Credit or debit card</label>
                    <div id="card-element" class="form-control">
                        <!-- A Stripe Element will be inserted here. -->
                    </div>
                    <div id="card-errors" role="alert" class="text-danger mt-2"></div>
                </div>
                <div class="form-group">
                    <label>Your Order</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="productName" value="{{ $product->product_name }}" readonly>
                        <span class="input-group-text bg-primary text-white rounded-end">
                            {{ $quantity }}
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label>Total Price</label>
                    <input type="text" class="form-control" id="totalPrice" value="{{ $totalPrice }}" readonly>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" name="address" id="address" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="country">Country</label>
                    <input type="text" name="country" id="country" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="postal_code">Postal Code</label>
                    <input type="number" name="postal_code" id="postal_code" class="form-control" min="1" required>
                </div>
                <input type="hidden" name="amount" id="amount" value="{{ $totalPrice }}">
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="quantity" value="{{ $quantity }}">
                <div class="customconnectwithus-innersection-left_inputcontainer d-flex flex-column my-1 text-center">
                    <button type="submit" class="btn btn-primary btn-sm mx-auto">Submit Payment</button>
                </div>
            </form>
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

        var form = document.getElementById('payment-form');
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

                        // Clear localStorage cart before form submission
                        localStorage.removeItem('cart');
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
