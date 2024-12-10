@extends('frontend.layouts.master')

@section('content')

<section class="container">
    <div class="itemsdetailsection py-4 row d-flex justify-content-center align-items-center">
        <div class="itemsdetailsection_imagecollection col-md-4 col-10 align-items-center order-md-1">
            <div class="itemsdetailsection_image">
                <img src="{{ asset($product->product_image) }}" alt="{{ $product->product_name }}" id="mainproductimage" class="img-fluid" />
            </div>
            <div class="itemsdetailsection_hoverimage d-flex justify-content-center mt-2">
                @if($product->other_images)
                    @foreach (json_decode($product->other_images) as $image)
                        <img src="{{ asset($image) }}" alt="{{ $product->product_name }}" onclick="moreimageFunc(this)" data-product-id="{{ $product->id }}" class="img-thumbnail mx-1" style="width: 60px; height: 60px; cursor: pointer;" />
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
                <span class="newprice">Rs.{{ $product->price }}</span>
                <div class="incres_dec py-2">
                    <span class="qty">Quantity</span>
                    <i class="fa-solid fa-plus" onclick="increaseQuantity()"></i>
                    <span id="quantity">0</span>
                    <i class="fa-solid fa-minus" onclick="decreaseQuantity()"></i>
                </div>
                <div class="totalprice py-2">
                    <span>Total Price: Rs.<span id="totalPrice">0</span></span>
                </div>
            </div>
            <div class="buy_addbuttom py-2">
                <button class="addtocart btn btn-warning">Add To Cart</button>
                <button class="buynow btn btn-primary">Buy Now</button>
            </div>
        </div>
    </div>
</section>

@endsection
