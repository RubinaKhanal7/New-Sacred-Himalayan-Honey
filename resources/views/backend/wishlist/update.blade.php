@extends('layouts2.superadmin')

@section('content')
<div class="container">
    <h1>Edit Wishlist Item</h1>
    <form action="{{ route('backend.wishlists.update', $wishlistItem->id) }}" method="POST">

        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="user_id">User</label>
            <select name="user_id" id="user_id" class="form-control">
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ $wishlist->user_id == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="product_id">Product</label>
            <select name="product_id" id="product_id" class="form-control">
                @foreach ($products as $product)
                    <option value="{{ $product->id }}" {{ $wishlist->product_id == $product->id ? 'selected' : '' }}>
                        {{ $product->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="product_name">Product Name</label>
            <input type="text" name="product_name" id="product_name" class="form-control"
                value="{{ $wishlist->product_name }}">
        </div>
        <button type="submit" class="btn btn-primary">Update Wishlist</button>
    </form>
</div>
@endsection
