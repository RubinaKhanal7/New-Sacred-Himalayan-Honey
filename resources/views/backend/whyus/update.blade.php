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
            <form id="quickForm" method="POST" action="{{ route('backend.whyus.update', $whyus->id) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{ $whyus->id }}">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control" id="title"
                        value="{{ $whyus->title ?? '' }}">
                </div>
                <div class="form-group">
                    <label for="subtitle">Subtitle</label><span style="color:red; font-size:large"> *</span>
                    <input type="text" name="subtitle" class="form-control" id="subtitle"
                        placeholder="Subtitle" value="{{ $whyus->subtitle }}">
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" name="image" class="form-control" id="image" onchange="previewImage(event)">
                    <img id="preview1" src="{{ asset('uploads/whyus/' . $whyus->image) }}"
                        style="max-width: 300px; max-height:300px" />
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Description</label>
                    <textarea style="width: 100%; min-height: 150px;" type="text" class="form-control" name="description"
                        id="description" placeholder="Add Description">{{ $whyus->description ?? '' }}</textarea>
                </div>

                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea id="content" name="content" style="width: 100%; min-height: 150px;">
                        {{ $whyus->content }}
                    </textarea>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </section>

    <!-- Main row -->
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
