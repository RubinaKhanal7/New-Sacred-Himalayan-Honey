@extends('layouts2.superadmin')

@section('content')
    <!-- Content Wrapper. Contains page content -->

    <!-- Content Header (Page header) -->

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
            <form id="quickForm" method="POST" action="{{ route('backend.photogalleries.update', $gallery->id) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">

                    <div class="form-group">
                        <label for="exampleInputEmail1">Image Title</label>
                        <input type="text" name="title" class="form-control" placeholder="Title"
                            value="{{ $gallery->title }}" required>
                    </div>

                    <div>
                        <label for="content">Description</label><span style="color:red; font-size:large">*</span>
                        <textarea style="max-width: 100%;min-height: 60px;" type="text" class="form-control" id="img_desc" name="img_desc"
                            placeholder="Add Description">{{ $gallery->img_desc }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"> Image <span style="color:red;"></span></label>
                        <span style="color:red; font-size:large"> *</span>
                        <input type="file" name="img[]" id="img" class="form-control" multiple
                            onchange="previewImage(event)">
                    </div>
                    <div id="imagePreview" class="mt-2">
                        @php
                            $images = is_array($gallery->img) ? $gallery->img : json_decode($gallery->img, true);
                        @endphp
                        @if (!empty($images))
                            @foreach ($images as $index => $imagePath)
                                <div class="existing-image">
                                    <img src="{{ asset($imagePath) }}" style="width: 100px; height: 100px; margin-right: 5px;">
                                    <input type="hidden" name="existing_images[]" value="{{ $imagePath }}">
                                    <button type="button" class="btn btn-sm btn-danger remove-image" data-image="{{ $imagePath }}">Remove</button>
                                </div>
                            @endforeach
                        @endif
                    </div>

                    <input type="hidden" name="removed_images" id="removedImages" value="">

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </section>

    @if (isset($links) && is_array($links))
        <div class="p-4">
            @foreach ($links as $link)
                <a href="{{ $link[1] }}">
                    <button class="btn btn-primary">{{ $link[0] }}</button>
                </a>
            @endforeach
        </div>
    @endif

    <style>
        .preview_image {
            max-width: calc(100% / 2);
            height: auto;
            margin: 5px;
        }
        .existing-image {
            display: inline-block;
            margin-right: 10px;
            margin-bottom: 10px;
        }
    </style>

    <script>
        let removedImages = [];

        const previewImage = e => {
            const files = e.target.files;
            const preview = document.getElementById('imagePreview');
            for (let i = 0; i < files.length; i++) {
                const reader = new FileReader();
                reader.onload = () => {
                    const div = document.createElement('div');
                    div.className = 'existing-image';
                    const img = document.createElement('img');
                    img.src = reader.result;
                    img.style.width = '100px';
                    img.style.height = '100px';
                    img.style.marginRight = '5px';
                    div.appendChild(img);
                    preview.appendChild(div);
                };
                reader.readAsDataURL(files[i]);
            }
        };

        // Remove existing image
        document.addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('remove-image')) {
                e.preventDefault();
                if (confirm('Are you sure you want to remove this image?')) {
                    const imageDiv = e.target.closest('.existing-image');
                    const imagePath = e.target.getAttribute('data-image');
                    removedImages.push(imagePath);
                    document.getElementById('removedImages').value = JSON.stringify(removedImages);
                    imageDiv.remove();
                }
            }
        });
    </script>

@endsection