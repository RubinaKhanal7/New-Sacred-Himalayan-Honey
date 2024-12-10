@extends('layouts2.superadmin')

@section('content')
    <div class="container">
        @if (Session::has('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif

        @if (Session::has('error'))
            <div class="alert alert-danger">{{ Session::get('error') }}</div>
        @endif

        <h1>Photo Gallery</h1>

        <a href="{{ route('backend.photogalleries.create') }}" class="btn btn-primary mb-3">Create Gallery</a>

        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>S.N.</th>
                    <th>Title</th>
                    <th>Image Description</th>
                    <th>Images</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php $serialNumber = 1; @endphp
                @foreach ($galleries as $gallery)
                    <tr>
                        <td>{{ $serialNumber++ }}</td>
                        <td>{{ $gallery->title }}</td>
                        <td>{{ $gallery->img_desc }}</td>
                        <td>
                            @if (!empty($gallery->img))
                                <div class="album-container">
                                    @foreach (json_decode($gallery->img) as $image)
                                        <img src="{{ asset($image) }}" class="album-image"
                                            style="width: 100px; height: 100px; margin-right: 5px;">
                                    @endforeach
                                </div>
                            @else
                                No images found.
                            @endif
                        </td>
                        <td>
                            <div style="display: flex; flex-direction: row;">
                                <a href="{{ route('backend.photogalleries.edit', $gallery->id) }}"
                                    class="btn btn-warning btn-sm" style="margin-right: 5px;">Edit</a>
                                
                                <button class="btn btn-danger btn-sm" data-toggle="modal"
                                    data-target="#deleteModal{{ $gallery->id }}">Delete</button>
                            </div>
                        </td>
                    </tr>
                    <!-- Delete Modal -->
                    <div class="modal fade" id="deleteModal{{ $gallery->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="deleteModalLabel{{ $gallery->id }}" aria-hidden="true">
                        <!-- Modal content -->
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
