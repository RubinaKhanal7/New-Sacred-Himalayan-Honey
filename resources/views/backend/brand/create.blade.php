<!-- create.blade.php -->
@extends('layouts2.superadmin')

@section('content')

io<div class="container">
    <h1>Create Brand</h1>

    <form action="{{ route('backend.brands.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="brand_name">Brand Name</label>
            <input type="text" name="brand_name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="category_id">Category</label>
            <select name="category_id" id="category_id" class="form-control" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
@endsection