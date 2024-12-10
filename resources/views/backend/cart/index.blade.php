@extends('layouts2.superadmin')

@section('content')
<div class="container">
    <h1>Cart Items</h1>
    <a href="{{ route('backend.carts.create') }}" class="btn btn-primary mb-3">Add Cart Item</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Customer</th>
                <th>Product</th>
                <th>Quantity</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cartItems as $cartItem)
                <tr>
                    <td>{{ $cartItem->customer->username }}</td>
                    <td>{{ $cartItem->product->id }}</td>
                    <td>{{ $cartItem->product_quantity }}</td>
                    <td>
                        <a href="{{ route('backend.carts.edit', $cartItem->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('backend.carts.destroy', $cartItem->id) }}" method="POST"
                            style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection