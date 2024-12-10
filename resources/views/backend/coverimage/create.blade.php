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


    <form id="quickForm" novalidate="novalidate" method="POST" action="{{ route('backend.coverimages.store') }}"
        enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="title">Title</label><span style="color:red; font-size:large"> *</span>
                <input style="width:auto;" type="text" name="title" class="form-control" id="title"
                    value="{{ old('title') }}" placeholder="Title">
            </div>

            <div class="form-group">
                <label for="image">Image</label><span style="color:red; font-size:large"> *</span>
                <input type="file" name="image" class="form-control" id="image" onchange="previewImage(event)"
                    placeholder="image" required>
            </div>
            <img id="preview" style="max-width: 500px; max-height:500px" />



        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>



    <script>
        function validateForm() {
            var input = document.getElementById('image');
            if (input.files.length > 0) {
                var fileSizeInMB = input.files[0].size / (1024 * 1024); // Convert bytes to MB
                if (fileSizeInMB > 2) {
                    alert('The image must be less than 2MB in size.');
                    return false; // Prevent form submission
                }
            }
            return true; // Allow form submission
        }
    </script>





    <script>
        const previewImage = e => {
            const reader = new FileReader();
            reader.readAsDataURL(e.target.files[0]);
            reader.onload = () => {
                const preview = document.getElementById('preview');
                preview.src = reader.result;
            };
        };
    </script>
@stop
