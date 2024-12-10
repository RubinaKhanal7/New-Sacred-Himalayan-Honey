@extends('layouts2.superadmin')

@section('content')
<div class="container">
    <h1>Edit Cart Item</h1>
    <form action="{{ route('backend.carts.update', $cart->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="user_id">Customer</label>
            <select name="user_id" id="user_id" class="form-control">
                @foreach ($customers as $customer)
                    <option value="{{ $customer->id }}" {{ $cart->user_id == $customer->id ? 'selected' : '' }}>
                        {{ $customer->username }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="product_id">Product</label>
            <select name="product_id" id="product_id" class="form-control">
                @foreach ($products as $product)
                    <option value="{{ $product->id }}" {{ $cart->product_id == $product->id ? 'selected' : '' }}>
                        {{ $product->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="product_quantity">Quantity</label>
            <input type="number" name="product_quantity" id="product_quantity" class="form-control"
                value="{{ $cart->product_quantity }}">
        </div>
        <button type="submit" class="btn btn-primary">Update Cart</button>
    </form>
</div>
@endsection
