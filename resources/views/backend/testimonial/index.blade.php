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
            <a href="{{ route('backend.testimonials.create') }}" class="btn btn-primary mb-3">Add Testimonial</a>
        </div>
    </div>

    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>S.N.</th>
                <th>Name</th>
                <th>Image</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @php
                $serialNumber = ($testimonials->currentPage() - 1) * $testimonials->perPage() + 1;
            @endphp

            @foreach ($testimonials as $testimonial)
                <tr data-widget="expandable-table" aria-expanded="false">
                    <td width="5%">{{ $serialNumber }}</td>
                    <td>{{ $testimonial->name ?? '' }}</td>
                    <td> <img id="preview{{ $loop->iteration }}"
                            src="{{ asset('uploads/testimonial/' . $testimonial->image) }}"
                            style="width: 150px; height:150px" /></td>
                    <td>{{ Str::limit(strip_tags($testimonial->description), 200) }}</td>
                    <td>
                        <!-- Edit Button -->
                        <a href="{{ route('backend.testimonials.edit', $testimonial->id) }}" class="btn btn-primary">Edit</a>

                        <!-- Delete Button -->
                        <form action="{{ route('backend.testimonials.destroy', $testimonial->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this testimonial?')">Delete</button>
                        </form>
                        
                    </td>
                </tr>
                @php
                $serialNumber++;
            @endphp
            @endforeach
        </tbody>
    </table>

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
    <!-- Pagination -->
{{-- <nav aria-label="Page navigation">
    <ul class="pagination justify-content-center">
        @if ($testimonials->onFirstPage())
            <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
        @else
            <li class="page-item"><a class="page-link" href="{{ $testimonials->previousPageUrl() }}" rel="prev">&laquo;</a></li>
        @endif

        @foreach ($testimonials->getUrlRange(1, $testimonials->lastPage()) as $page => $url)
            @if ($page == $testimonials->currentPage())
                <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
            @else
                <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
            @endif
        @endforeach

        @if ($testimonials->hasMorePages())
            <li class="page-item"><a class="page-link" href="{{ $testimonials->nextPageUrl() }}" rel="next">&raquo;</a></li>
        @else
            <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
        @endif
    </ul>
</nav> --}}

@endsection
