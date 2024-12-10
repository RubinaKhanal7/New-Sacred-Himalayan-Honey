@extends('frontend.layouts.master')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<section class="container">
    <div class="itemsdetailsection py-4 row d-flex justify-content-center align-items-center">
        <div class="itemsdetailsection_imagecollection col-md-4 col-10 align-items-center order-md-1">
            <div class="itemsdetailsection_image">
                <img src="{{ asset($product->product_image) }}" alt="{{ $product->product_name }}" id="mainproductimage" class="img-fluid" />
            </div>
            <div class="itemsdetailsection_hoverimage d-flex justify-content-center mt-2">
                @if($product->other_images)
                    @foreach (json_decode($product->other_images) as $image)
                        <img src="{{ asset($image) }}" alt="{{ $product->product_name }}" onclick="moreimageFunc(this)" class="img-thumbnail mx-1" style="width: 60px; height: 60px; cursor: pointer;" />
                    @endforeach
                @endif
            </div>         
        </div>
        <div class="description col-md-5 col-12 align-items-center order-md-1 order-3">
            <h2>Description about Product</h2>
            <div class="productdescription">
                <p>
                    <i class="fa-regular fa-hand-point-right"></i>
                    <span>{{ $product->description }}</span>
                </p>
            </div>
        </div>
        <div class="addtocartandbuysection col-md-3 col-11 py-2 order-md-1 order-2 my-3">
            <h5 class="py-2">{{ $product->product_name }}</h5>
            <div class="pricecollection d-flex flex-column py-1">
                <span class="newprice">${{ $product->selling_price }}</span>
                <div class="incres_dec py-2">
                    <span class="qty">Quantity</span>
                    <i class="fa-solid fa-plus" onclick="increaseQuantity()"></i>
                    <span id="quantity">1</span>
                    <i class="fa-solid fa-minus" onclick="decreaseQuantity()"></i>
                </div>
                <div class="totalprice py-2">
                    <span>Total Price: $<span id="totalPrice">{{ $product->selling_price }}</span></span>
                </div>
            </div>
            <div class="buy_addbuttom py-2">
                <button onclick="showPaymentModal()" class="buynow btn btn-primary">Buy Now</button>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentModalLabel">Payment Options</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Please select your payment method:</p>
                <div class="d-flex flex-column justify-content-between">
                    @if(!auth()->check())
                        <button class="btn btn-primary mb-2" onclick="proceedToPayment('{{ $product->id }}', '{{ route('login') }}', '{{ route('payment', ['id' => $product->id]) }}', true)">Pay with Login</button>
                        <button class="btn btn-warning mb-2" onclick="proceedToPayment('{{ $product->id }}', null, '{{ route('newpayment', ['id' => $product->id]) }}', false)">Pay without Login</button>
                    @endif
                    <div id="paypal-button-container"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include PayPal SDK -->
<script src="https://www.paypal.com/sdk/js?client-id={{ config('paypal.' . config('paypal.mode') . '.client_id') }}&currency=USD&intent=capture&debug=true"></script>

<script>
    const productPrice = {{ $product->selling_price }};

    function updateTotalPrice(quantity) {
        const totalPriceElement = document.getElementById('totalPrice');
        totalPriceElement.innerText = (quantity * productPrice).toFixed(2);
    }

    function moreimageFunc(element) {
        const mainproductimage = document.getElementById("mainproductimage");
        const newimage = element.src;
        mainproductimage.src = newimage;
    }

    function increaseQuantity() {
        let quantityElement = document.getElementById('quantity');
        let quantity = parseInt(quantityElement.innerText);
        quantity++;
        quantityElement.innerText = quantity;
        updateTotalPrice(quantity);
    }

    function decreaseQuantity() {
        let quantityElement = document.getElementById('quantity');
        let quantity = parseInt(quantityElement.innerText);
        if (quantity > 1) {
            quantity--;
            quantityElement.innerText = quantity;
            updateTotalPrice(quantity);
        }
    }

    function showPaymentModal() {
        const paymentModal = new bootstrap.Modal(document.getElementById('paymentModal'));
        paymentModal.show();
    }

    function proceedToPayment(productId, loginRoute, paymentRoute, isLoginRequired) {
        const quantity = document.getElementById('quantity').innerText;
        const totalPrice = document.getElementById('totalPrice').innerText;

        if (isLoginRequired) {
            sessionStorage.setItem('intendedPaymentRoute', paymentRoute);
            sessionStorage.setItem('quantity', quantity);
            sessionStorage.setItem('totalPrice', totalPrice);
            window.location.href = loginRoute;
        } else {
            window.location.href = `${paymentRoute}?quantity=${quantity}&totalPrice=${totalPrice}`;
        }
    }
//paypal button
    document.addEventListener("DOMContentLoaded", function() {
    if (typeof paypal !== 'undefined') {
        paypal.Buttons({
            createOrder: function(data, actions) {
                const quantity = document.getElementById('quantity').innerText;
                const totalPrice = document.getElementById('totalPrice').innerText;

                console.log('Creating order:', { quantity, totalPrice });

                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: totalPrice
                        },
                        description: '{{ $product->product_name }}',
                        custom_id: '{{ $product->id }}',
                    }],
                    application_context: {
                        shipping_preference: 'NO_SHIPPING'
                    }
                });
            },
            onApprove: function(data, actions) {
                console.log('Payment approved:', data);
                return actions.order.capture().then(function(details) {
                    console.log('Order captured:', details);
                    return fetch('{{ route('handle.payment.success') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            orderID: data.orderID,
                            payerID: data.payerID,
                            paymentID: details.id,
                            paymentStatus: details.status,
                            productId: {{ $product->id }},
                            quantity: document.getElementById('quantity').innerText,
                            totalPrice: document.getElementById('totalPrice').innerText
                        })
                    })
                    .then(response => response.json())
                    .then(result => {
                        console.log('Server response:', result);
                        if (result.status === 'success') {
                            localStorage.removeItem('cart');
                            sessionStorage.removeItem('cart');
                            
                            window.location.href = result.redirectUrl;
                        } else {
                            throw new Error(result.message || 'Unknown error occurred');
                        }
                    })
                    .catch(error => {
                        console.error('Error processing payment:', error);
                        alert('Error processing payment: ' + error.message);
                    });
                });
            },
            onCancel: function (data) {
                console.log('Payment cancelled:', data);
                alert('Payment cancelled');
            },
            onError: function (err) {
                console.error('PayPal error:', err);
                alert('An error occurred with PayPal. Please try again. Error: ' + err);
            }
        }).render('#paypal-button-container');
    } else {
        console.error('PayPal SDK is not loaded.');
    }
});
</script>
@endsection
