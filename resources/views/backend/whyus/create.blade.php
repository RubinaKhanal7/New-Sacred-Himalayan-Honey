@extends('layouts2.superadmin')

@section('content')
    <!-- Content Wrapper. Contains page content -->

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

    <form id="quickForm" method="POST" action="{{ route('backend.whyus.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="exampleInputEmail1">Title</label>
                <input type="text" name="title" class="form-control" placeholder="Title" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Subtitle</label>
                <input type="text" name="subtitle" class="form-control" placeholder="Subtitle">
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Image</label>
                <input type="file" name="image" class="form-control" onchange="previewImage(event)" placeholder="Image"
                    required>
                <div id="imagePreview" class="mt-2"></div>
            </div>

            <div class="form-group">
                <label for="description">Description</label><span style="color:red; font-size:large"> *</span>
                <textarea style="width: 100%; min-height: 150px;" type="text" class="form-control" name="description"
                    id="description" placeholder="Add Description">{{ old('description') }}</textarea>
            </div>

            <div class="form-group">
                <label for="content">Content</label><span style="color:red; font-size:large"> *</span>
                <textarea style="width: 100%; min-height: 300px;" id="content" name="content">{{ old('content') }}</textarea>
            </div>

        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Create</button>
        </div>
    </form>

    <!-- Main row -->
    <script>

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

@stop
