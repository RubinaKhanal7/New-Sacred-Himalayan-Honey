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


    <section class="content">
        <div class="container-fluid">
            <form id="quickForm" method="POST" action="{{ route('backend.videogalleries.update', $video->id) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{ $video->id }}">
                <div class="form-group">
                    <label for="title">Title</label><span style="color:red; font-size:large"> *</span>
                    <input style="width:auto;" type="text" name="title" class="form-control" id="title"
                        placeholder="Title" value="{{ $video->title }}">
                </div>

                <div class="form-group">
                    <label for="Url">URL</label><span style="color:red; font-size:large"> *</span>
                    <input style="width:auto;" type="text" name="url" class="form-control" id="url"
                        placeholder="Url" value="{{ old('url', $video->url) }}">

                </div>




        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
        </form>
        </div>
    </section>



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
