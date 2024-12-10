<!-- index.blade.php -->
@extends('layouts2.superadmin')

@section('content')
<div class="container">
    <h1>Categories</h1>

    <a href="{{ route('backend.categories.create') }}" class="btn btn-primary mb-3">Create Category</a>

    <table class="table">
        <thead>
            <tr>
                <th>Category Name</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->category_name }}</td>
                    <td>{{ $category->description }}</td>
                    <td>
                        <a href="{{ route('backend.categories.edit', $category->id) }}"
                            class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('backend.categories.destroy', $category->id) }}" method="POST"
                            style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                            onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
