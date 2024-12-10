<!-- resources/views/wishlist/index.blade.php -->
@extends('layouts2.superadmin')

@section('content')
<div class="container">
    <h1>Wishlist Items</h1>
    <a href="{{ route('backend.wishlists.create') }}" class="btn btn-primary mb-3">Add Wishlist Item</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>User</th>
                <th>Product</th>
                <th>Product Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($wishlists as $wishlist)
                <tr>
                    <td>{{ $wishlist->user->name }}</td>
                    <td>{{ $wishlist->product->name }}</td>
                    <td>{{ $wishlist->product_name }}</td>
                    <td>
                        <a href="{{ route('backend.wishlists.edit', $wishlist->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('backend.wishlists.destroy', $wishlist->id) }}" method="POST"
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
