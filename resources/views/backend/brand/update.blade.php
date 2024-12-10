<!-- update.blade.php -->
@extends('layouts2.superadmin')

@section('content')

<div class="container">
    <h1>Edit Brand</h1>

    <form action="{{ route('backend.brands.update', $brand->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="brand_name">Brand Name</label>
            <input type="text" name="brand_name" class="form-control" value="{{ $brand->brand_name }}" required>
        </div>

        <div class="form-group">
            <label for="category_id">Category</label>
            <select name="category_id" id="category_id" class="form-control" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @if ($category->id == $brand->category_id) selected @endif>
                        {{ $category->category_name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
