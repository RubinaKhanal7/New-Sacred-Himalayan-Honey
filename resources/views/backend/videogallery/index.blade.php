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

    <h1>Video Gallery</h1>

    <a href="{{ route('backend.videogalleries.create') }}" class="btn btn-primary mb-3">Create Video Gallery</a>

    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>S.N.</th>
                <th>Title</th>
                <th>Video</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @php
                $serialNumber = ($videos->currentPage() - 1) * $videos->perPage() + 1;
            @endphp
            @foreach ($videos as $video)
                <tr>
                    <td width="5%">{{ $serialNumber }}</td>
                    <td>{{ $video->title ?? '' }}</td>
                    <td>
                        @if($video->video_id)
                            <div class="embed-responsive embed-responsive-16by9" style="width: 200px; height: 150px;">
                               
                                <iframe width="200" height="150" src="{{ $video->url }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                            </div>
                        @else
                            <p>Invalid YouTube URL</p>
                        @endif
                    </td>
                    <td>
                        <div style="display: flex; flex-direction: row;">
                            <a href="{{ route('backend.videogalleries.edit', $video->id) }}" class="btn btn-warning btn-sm"
                                style="margin-right: 5px;">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <button onclick="deleteVideo({{ $video->id }})" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </div>
                    </td>
                </tr>
                @php
                    $serialNumber++;
                @endphp
            @endforeach
        </tbody>
    </table>

    <div class="modal fade" id="deleteVideoModal" tabindex="-1" role="dialog" aria-labelledby="deleteVideoModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteVideoModalLabel">Delete Video</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this video?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="deleteVideoForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{ $videos->links() }}

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script>
        function deleteVideo(id) {
            var url = "{{ route('backend.videogalleries.destroy', ':id') }}";
            url = url.replace(':id', id);
            $('#deleteVideoForm').attr('action', url);
            var deleteModal = new bootstrap.Modal(document.getElementById('deleteVideoModal'));
            deleteModal.show();
        }
    </script>
@endsection