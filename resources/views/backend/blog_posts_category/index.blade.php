@extends('layouts2.superadmin')

@section('content')
    @if (Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif

    @if (Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error') }}
        </div>
    @endif

    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">{{ $page_title }}</h1>
            <a href="{{ route('backend.blogpostscategories.create') }}" class="btn btn-primary mb-3">Add Blog Post Category</a>
        </div>
    </div>

    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>S.N</th>
                <th>Title</th>
                <th>Image</th>
                <th>Content</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr data-widget="expandable-table" aria-expanded="false">
                    <td width="5%">{{ $loop->iteration }}</td>
                    <td>{{ $category->title }}</td>
                    <td>
                        <img id="preview{{ $loop->iteration }}" src="{{ asset('uploads/blogpostcategory/' . $category->image) }}" style="width: 150px; height:150px" />
                    </td>
                    <td>{{ Str::limit(strip_tags($summernoteContent->processContent($category->content)), 200) }}</td>
                    <td>
                        <!-- Edit Button -->
                        <a href="{{ route('backend.blogpostscategories.edit', $category->id) }}" class="btn btn-primary">Edit</a>

                        <!-- Delete Button -->
                        <form action="{{ route('backend.blogpostscategories.destroy', $category->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this blog?')">Delete</button>
                        </form>
                        
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
@endsection
