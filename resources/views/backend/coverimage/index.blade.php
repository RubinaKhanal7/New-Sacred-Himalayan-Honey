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

    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">{{ $page_title }}</h1>
            <a href="{{ route('backend.coverimages.create') }}" class="btn btn-primary mb-3">Add Cover Image</a>
        </div>
    </div>

    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>S.N.</th>
                <th>Title</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @php
                $serialNumber = ($coverimages->currentPage() - 1) * $coverimages->perPage() + 1;
            @endphp
            @foreach ($coverimages as $coverimage)
                <tr data-widget="expandable-table" aria-expanded="false">
                    <td width="5%">{{ $serialNumber }}</td>
                    <td>{{ $coverimage->title ?? '' }}</td>
                    <td> <img id="preview{{ $loop->iteration }}"
                            src="{{ asset('uploads/coverimage/' . $coverimage->image) }}"
                            style="width: 150px; height:150px" /></td>
                            <td>
                                <!-- Edit Button -->
                                <a href="{{ route('backend.coverimages.edit', $coverimage->id) }}" class="btn btn-primary">Edit</a>
        
                                <!-- Delete Button -->
                                <form action="{{ route('backend.coverimages.destroy', $coverimage->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this blog?')">Delete</button>
                                </form>
                                
                            </td>
                </tr>
                @php
        $serialNumber++;
    @endphp
</tr>
            @endforeach
        </tbody>

    </table>
    
    <!-- Pagination -->
    {{-- <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            @if ($coverimages->onFirstPage())
                <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
            @else
                <li class="page-item"><a class="page-link" href="{{ $coverimages->previousPageUrl() }}" rel="prev">&laquo;</a></li>
            @endif

            @foreach ($coverimages->getUrlRange(1, $coverimages->lastPage()) as $page => $url)
                @if ($page == $coverimages->currentPage())
                    <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                @else
                    <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                @endif
            @endforeach

            @if ($coverimages->hasMorePages())
                <li class="page-item"><a class="page-link" href="{{ $coverimages->nextPageUrl() }}" rel="next">&raquo;</a></li>
            @else
                <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
            @endif
        </ul>
    </nav> --}}
    <script>
        const previewImage1 = e => {
            const reader = new FileReader();
            reader.readAsDataURL(e.target.files[0]);
            reader.onload = () => {
                const preview = document.getElementById('preview1');
                preview.src = reader.result;
            };
        };
    </script>
    
@endsection
