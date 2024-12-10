@extends('layouts2.superadmin')
@section('content')
    <!-- Content Wrapper. Contains page content -->

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="container">
        <h1>Create New Blog Post Category</h1>
        <form method="POST" action="{{ route('backend.blogpostscategories.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" class="form-control" id="image" name="image" onchange="previewImage(event)">
                <div id="imagePreview" class="mt-2"></div>
            </div>
            <div class="form-group">
                <label for="content">Content:</label>
                <textarea class="form-control summernote" id="content" name="content" rows="10" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
        <script>
            // $(document).ready(function() {
            //     $('.summernote').summernote();
            // });

            $('#content').summernote({
            placeholder: 'Enter message here...',
            tabsize: 2,
            height: 100
        });


            function previewImage(event) {
                var input = event.target;
                var preview = document.getElementById('imagePreview');

                while (preview.firstChild) {
                    preview.removeChild(preview.firstChild); // Clear previous preview
                }

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        var img = document.createElement('img');
                        img.src = e.target.result;
                        img.style.maxWidth = '200px'; // Adjust the maximum width as needed
                        img.style.maxHeight = '200px'; // Adjust the maximum height as needed
                        preview.appendChild(img);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>
    </div>
@endsection
