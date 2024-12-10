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
    <div class="container">
        <h1>Edit Blog Post Category</h1>
        <form method="POST" action="{{ route('backend.blogpostscategories.update', $blogPostsCategory->id) }}"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <a href="{{ route('backend.blogpostscategories.index') }}" class="btn btn-secondary">Back</a>
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control" id="title" name="title"
                    value="{{ $blogPostsCategory->title }}" required>
            </div>
            
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" name="image" class="form-control" id="image" onchange="previewImage(event)">
                <img id="preview1" src="{{ asset('uploads/blogpostcategory/' . $blogPostsCategory->image) }}"
                    style="max-width: 300px; max-height:300px" />
            </div>
            <div id="imagePreview" class="mt-2"></div>
            <div class="form-group">
                <label for="content">Content:</label>
                <textarea class="form-control summernote" id="content" name="content" rows="5" required>{{ $blogPostsCategory->content }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <!-- Update the back button to redirect to the index route -->

        </form>
    </div>

    <script>
        $('#content').summernote({
            placeholder: 'Enter message here...',
            tabsize: 2,
            height: 100
        });

        const previewImage = e => {
            const reader = new FileReader();
            reader.readAsDataURL(e.target.files[0]);
            reader.onload = () => {
                const preview = document.getElementById('preview1');
                preview.src = reader.result;
            };
        };
    </script>
@endsection
