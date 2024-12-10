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
   
    <h1>About Us</h1>
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>S.N.</th>
                <th>Title</th>
                <th>Subtitle</th>
                <th>Image</th>
                <th>Description</th>
                <th>Content</th> 
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($abouts as $about)
                <tr data-widget="expandable-table" aria-expanded="false">
                    <td width="5%">{{ $loop->iteration }}</td>
                    <td>{{ $about->title ?? '' }}</td>
                    <td>{{ $about->subtitle ?? '' }}</td>
                    <td><img id="preview{{ $loop->iteration }}" src="{{ asset('uploads/about/' . $about->image) }}"
                            style="width: 150px; height:150px" /></td>
                    <td>{{ Str::limit(strip_tags($about->description), 200) }}</td>
                    <td>{{ Str::limit(strip_tags($about->content), 200) }}</td>

                    <td>
                        <div style="display: flex; flex-direction:row;">
                            <a href="{{ route('backend.aboutus.edit', $about->id) }}" class="btn btn-warning btn-sm"
                                style="margin-right: 5px;"><i class="fas fa-edit"></i> Edit</a>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Main row -->

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
@endsection
