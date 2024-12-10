@extends('frontend.layouts.master')

@section('content')
    <!-- Image Gallery Section -->
    <section class="container">
        <div class="startofgallerypage py-5">
            <div class="titlebannnersection">
                <!-- ... (title section remains unchanged) ... -->
            </div>
            <div class="row wrap d-flex justify-content-between particularimagesection">
                @forelse ($images as $image)
                    <div class="col-md-4 mt-3 mb-3">
                        <div class="gallery-item">
                            <h4 class="text-center mb-3">{{ $image->title }}</h4>
                            <div class="image-container">
                                @php
                                    $imgUrls = json_decode($image->img, true);
                                @endphp
                                @if (is_array($imgUrls) && count($imgUrls) > 0)
                                    <div class="image-group" data-gallery="{{ $image->id }}">
                                        {{-- Main Image --}}
                                        <div class="gallery-image main-image col-4">
                                            <a class="image-link" href="{{ asset($imgUrls[0]) }}" title="{{ $image->title }} - Main Image">
                                                <img src="{{ asset($imgUrls[0]) }}" alt="{{ $image->title }} - Main Image">
                                            </a>
                                        </div>
            
                                        {{-- Sub Images --}}
                                        @if (count($imgUrls) > 1)
                                            <div class="sub-images">
                                                @foreach (array_slice($imgUrls, 1) as $index => $imgUrl)
                                                    <div class="sub-image">
                                                        <a class="image-link" href="{{ asset($imgUrl) }}" title="{{ $image->title }} - Image {{ $index + 2 }}">
                                                           
                                      <img src="{{ asset($imgUrl) }}" alt="{{ $image->title }} - Image {{ $index + 2 }}">
                                                        </a>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                @else
                                    <p>No images found for this gallery</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p>No galleries found.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
    <!-- End Image Gallery Section -->

    <!-- Include Magnific Popup CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">

    <!-- Include jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Include Magnific Popup JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>

    <!-- Magnific Popup Initialization -->
    <script>
        $(document).ready(function(){
            console.log('Document ready, initializing Magnific Popup...');
            $('.image-group').each(function() {
                $(this).magnificPopup({
                    delegate: 'a',
                    type: 'image',
                    gallery: {
                        enabled: true
                    }
                });
            });
        });
    </script>

@endsection