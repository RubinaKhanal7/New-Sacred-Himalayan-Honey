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


    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form id="quickForm" method="POST" action="{{ route('backend.coverimages.update', $coverimage->id) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control" id="title"
                        value="{{ $coverimage->title ?? '' }}">
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" name="image" class="form-control" id="image" onchange="previewImage(event)">
                    <img id="preview1" src="{{ asset('uploads/coverimage/' . $coverimage->image) }}"
                        style="max-width: 300px; max-height:300px" />
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </section>
    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const preview = document.getElementById('preview1');
                preview.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection
