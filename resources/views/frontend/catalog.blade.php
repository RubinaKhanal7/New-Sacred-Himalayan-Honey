@extends('frontend.layouts.master')

@section('content')
<!-- Include CSRF Token Meta Tag -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<section class="container">
    @if(session('success_message'))
    <div class="alert alert-success">{{ session('success_message') }}</div>
    @endif
    <div class="cart-section">
        <div class="cart-container">
            <div class="cart-items" id="cartItems">
                <!-- Cart items will be dynamically inserted here -->
            </div>
            <div class="order-summary">
                <h4 style="color:#8B4513 ">Order Summary</h4>
                <span class="summary-line"></span>
                <div id="orderSummary">
                    <!-- Order summary will be dynamically inserted here -->
                </div>
                <button type="button" class="buy-button" onclick="openPaymentModal()">Buy now</button>
            </div>
        </div>
    </div>
</section>

<!-- Modal for Payment Options -->
<div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentModalLabel">Choose Payment Option</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex flex-column">
                    <button type="button" class="btn btn-primary mb-2 w-100" onclick="handleLoginPayment()">Pay with Login</button>
                    <hr>
                    <div id="paypal-button-container" class="w-100"></div>
                    <hr>
                </div>
            </div>
            
        </div>
    </div>
</div>

<script src="https://www.paypal.com/sdk/js?client-id={{ config('paypal.' . config('paypal.mode') . '.client_id') }}&currency=USD&intent=capture&debug=true"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let cart = JSON.parse(localStorage.getItem('cart') || '{}');
    const cartItemsContainer = document.getElementById('cartItems');
    const orderSummaryContainer = document.getElementById('orderSummary');

    function updateCart() {
        cartItemsContainer.innerHTML = '';
        let total = 0;
        let totalItems = 0;

        for (let productId in cart) {
            let product = cart[productId];
            total += product.price * product.quantity;
            totalItems += product.quantity;

            let itemHtml = `
                <div class="cart-item">
                    <h5>${product.name}</h5>
                    <p>Price: $. ${product.price}</p>
                    <div class="quantity-control">
                        <button onclick="changeQuantity('${productId}', -1)">-</button>
                        <span id="quantity-${productId}">${product.quantity}</span>
                        <button onclick="changeQuantity('${productId}', 1)">+</button>
                    </div>
                    <p>Total: $. ${product.price * product.quantity}</p>
                    <button class="remove-btn" onclick="removeItem('${productId}')">
                        <i class="fa fa-trash"></i> Remove
                    </button>
                </div>
            `;
            cartItemsContainer.innerHTML += itemHtml;
        }

        orderSummaryContainer.innerHTML = `
            <div class="summary-item">
                <h5>Total Items</h5>
                <h5>${totalItems}</h5>
            </div>
            <div class="summary-item">
                <h5>Total Price</h5>
                <h5>$. ${total}</h5>
            </div>
        `;

        localStorage.setItem('cart', JSON.stringify(cart));
        updateCartCount();
    }

    window.changeQuantity = function(productId, change) {
        cart[productId].quantity += change;
        if (cart[productId].quantity < 1) {
            cart[productId].quantity = 1;
        }
        updateCart();
    }

    window.removeItem = function(productId) {
        delete cart[productId];
        updateCart();
    }

    window.updateCartCount = function() {
        let cartCount = Object.values(cart).reduce((total, item) => total + item.quantity, 0);
        let cartCountElement = document.getElementById('cartCount');
        if (cartCountElement) {
            cartCountElement.textContent = cartCount;
        }
    }

    updateCart();

    // PayPal Integration
    if (document.getElementById('paypal-button-container')) {
    paypal.Buttons({
        createOrder: function(data, actions) {
            let cart = JSON.parse(localStorage.getItem('cart') || '{}');
            let totalPrice = Object.values(cart).reduce((sum, product) => sum + (product.price * product.quantity), 0);

            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: totalPrice.toFixed(2)
                    }
                }]
            });
        },
        onApprove: function(data, actions) {
            return actions.order.capture().then(function(details) {
                let cart = JSON.parse(localStorage.getItem('cart') || '{}');
                let products = Object.values(cart).map(product => ({
                    id: parseInt(product.id),
                    quantity: product.quantity,
                    price: product.price
                }));
                let totalPrice = products.reduce((sum, product) => sum + (product.price * product.quantity), 0);

                // Check if CSRF token exists
                let csrfToken = document.querySelector('meta[name="csrf-token"]');
                if (!csrfToken) {
                    alert('CSRF token not found.');
                    return;
                }

                return fetch('{{ route('handle.bulk.payment.success') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken.getAttribute('content') 
                    },
                    body: JSON.stringify({
                        orderID: data.orderID,
                        payerID: data.payerID,
                        paymentID: details.id,
                        paymentStatus: details.status,
                        products: products,
                        totalPrice: totalPrice.toFixed(2)
                    })
                })
                .then(response => response.json())
                .then(result => {
                    if (result.status === 'success') {
                        // Clear cart and redirect
                        localStorage.removeItem('cart');
                        window.location.href = result.redirectUrl;
                    } else {
                        throw new Error(result.message || 'Unknown error occurred');
                    }
                })
                .catch(error => {
                    console.error('Payment error:', error);
                    alert('Error processing payment: ' + (error.message || 'Unknown error occurred'));
                });
            });
        },
        onCancel: function(data) {
            alert('Payment was cancelled. Transaction ID: ' + data.orderID);
        },
        onError: function(err) {
            alert('An error occurred during payment: ' + err.message || 'Unknown error occurred');
        }
    }).render('#paypal-button-container');
}

    @auth
        if (localStorage.getItem('redirectToBulkPayment') === 'true') {
            localStorage.removeItem('redirectToBulkPayment');
            redirectToBulkPayment();
        }
    @endauth
});

function openPaymentModal() {
    const paymentModal = new bootstrap.Modal(document.getElementById('paymentModal'));
    paymentModal.show();
}

function handleLoginPayment() {
    @auth
        redirectToBulkPayment();
    @else
        let cart = JSON.parse(localStorage.getItem('cart') || '{}');
        let products = Object.values(cart);
        let totalQuantity = products.reduce((sum, product) => sum + product.quantity, 0);
        let totalPrice = products.reduce((sum, product) => sum + (product.price * product.quantity), 0);

        let cartData = encodeURIComponent(JSON.stringify({
            products: products,
            totalQuantity: totalQuantity,
            totalPrice: totalPrice
        }));

        sessionStorage.setItem('intendedPaymentRoute', "{{ route('bulk.payment') }}?products=" + cartData);
        window.location.href = "{{ route('login') }}?cart_data=" + cartData;
    @endauth
}

function redirectToBulkPayment() {
    let cart = JSON.parse(localStorage.getItem('cart') || '{}');
    let products = Object.values(cart);
    let totalQuantity = products.reduce((sum, product) => sum + product.quantity, 0);
    let totalPrice = products.reduce((sum, product) => sum + (product.price * product.quantity), 0);

    if (totalQuantity > 0) {
        window.location.href = `{{ route('bulk.payment') }}?products=${encodeURIComponent(JSON.stringify(products))}&totalQuantity=${totalQuantity}&totalPrice=${totalPrice}`;
    } else {
        alert('Your cart is empty. Please add products to the cart before proceeding with the bulk payment.');
    }
}
</script>
@endsection
