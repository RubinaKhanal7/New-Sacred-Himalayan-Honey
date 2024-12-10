<!-- index.blade.php -->
@extends('layouts2.superadmin')

@section('content')

    <div class="container">
        <h1>Brands</h1>

        <a href="{{ route('backend.brands.create') }}" class="btn btn-primary mb-3">Create Brand</a>

        <table class="table">
            <thead>
                <tr>
                    <th>Brand Name</th>
                    <th>Category</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($brands as $brand)
                    <tr>
                        <td>{{ $brand->brand_name }}</td>
                        <td>{{ $brand->category->category_name }}</td>
                        <td>
                            <a href="{{ route('backend.brands.edit', $brand->id) }}" class="btn btn-sm btn-primary">Edit</a>
                            <!-- Add delete button here if needed -->
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endsection
