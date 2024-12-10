<!-- update.blade.php -->

@extends('layouts2.superadmin')

@section('content')


<div class="container">
    <h1>Edit Category</h1>

    <form action="{{ route('backend.categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="category_name">Category Name</label>
            <input type="text" name="category_name" class="form-control" value="{{ $category->category_name }}" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control" required>{{ $category->description }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection

