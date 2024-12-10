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

    <form id="quickForm" method="POST" action="{{ route('backend.testimonials.update', $testimonials->id) }}"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Enter name"
                    value="{{ $testimonials->name }}" required>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" name="image" class="form-control" id="image" onchange="previewImage(event)">
                <img id="preview1" src="{{ asset('uploads/testimonial/' . $testimonials->image) }}"
                    style="max-width: 300px; max-height:300px" />
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" name="description" id="description" rows="3" required>{{ $testimonials->description }}</textarea>
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
    <script>
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
