@extends('layouts2.superadmin')

@section('content')
<div class="container">
    <h1>Create Cart Item</h1>
    <form action="{{ route('backend.carts.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="user_id">Customer</label>
            <select name="user_id" id="user_id" class="form-control" required>
                @foreach ($customers as $customer)
                    <option value="{{ $customer->id }}">{{ $customer->username }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="product_id">Product</label>
            <select name="product_id" id="product_id" class="form-control" required style="color: black;">
                @foreach ($products as $product)
                    <option value="{{ $product->id }}">{{ $product->id }} - {{ $product->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="product_quantity">Quantity</label>
            <input type="number" name="product_quantity" id="product_quantity" class="form-control" required
                min="1">
        </div>
        <button type="submit" class="btn btn-primary">Add to Cart</button>
    </form>
</div>
@endsection
