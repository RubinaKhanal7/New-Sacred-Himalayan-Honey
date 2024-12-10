<!-- create.blade.php -->
@extends('layouts2.superadmin')

@section('content')
    <div class="container">
        <h1>Create Category</h1>

        <form action="{{ route('backend.categories.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="category_name">Category Name</label>
                <input type="text" name="category_name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
    @endsection
    

