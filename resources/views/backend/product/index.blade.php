@extends('layouts2.superadmin')

@section('content')
    <div class="container">
        <h1>Products</h1>

        <a href="{{ route('backend.products.create') }}" class="btn btn-primary mb-3">Create Product</a>

        <table class="table">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Description</th>
                    <th>Cost Price</th>
                    <th>Selling Price</th>
                    <th>Product Quantity</th>
                    <th>Category</th>
                    <th>Brand</th>
                    <th>Material</th>
                    <th>Status</th>
                    <th>Product Image</th>
                    <th>Other Images</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->product_name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->cost_price }}</td>
                        <td>{{ $product->selling_price }}</td>
                        <td>{{ $product->product_quantity }}</td>
                        <td>{{ $product->category->category_name }}</td>
                        <td>{{ $product->brand->brand_name }}</td>
                        <td>{{ $product->material }}</td>
                        <td>{{ $product->status }}</td>
                        <td>
                            @if ($product->product_image)
                                <img src="{{ asset($product->product_image) }}" style="width: 50px; height: 50px;"
                                    alt="Product Image">
                            @else
                                <span>No Image</span>
                            @endif
                        </td>
                        <td>
                            @php
                                $otherImages = json_decode($product->other_images);
                            @endphp

                            @if ($otherImages && is_array($otherImages) && count($otherImages) > 0)
                                @foreach ($otherImages as $otherImage)
                                    <img src="{{ asset($otherImage) }}" style="width: 50px; height: 50px;" alt="Other Image">
                                @endforeach
                            @else
                                <span>No Other Images</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('backend.products.edit', $product->id) }}"
                                class="btn btn-sm btn-primary">Edit</a>
                            <!-- You can add more actions like delete if needed -->
                            <form action="{{ route('backend.products.destroy', $product->id) }}" method="POST"
                                style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
