@extends('frontend.layouts.master')

@section('content')
    
    <section class="container">
        <div class="herosection row">
          <div class="herosection_image-container col-md-12">
            <img src="../image/about/contacthero.png" alt="" srcset="" />
          </div>
          <span class="section-overlay d-flex flex-column align-items-center">
            <h2>ARE you happy with our video ?</h2>
          </span>
        </div>
    </section>
    <section class="container">
        <div class="startofgallerypage">
          <div class="titlebannnersection py-5">
            <span class="d-flex flex-column justify-content-center align-items-center containertitle">
              <h2 class="d-flex justify-content-center">Why sacred himalyan honey </h2>
              <div class="titlelongerbanner">
                <p class="titleline"></p>
                <span class="titlebannertext">SACRED HIMALAYAN HONEY</span>
                <p class="titleline"></p>
              </div>
            </span>
          </div>
            <div class="row m-3">
                @forelse ($videos as $video)
                    <div class="col-md-4  align-items-center">
                        <iframe
                            src="{{ $video->url }}"
                            title="{{ $video->title }}" 
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            referrerpolicy="strict-origin-when-cross-origin" 
                            class="col-md-12 mx-5 px-5 videocard"
                            allowfullscreen>
                        </iframe>
                    </div>
                @empty
                    <div class="col-12">
                        <p>No videos found.</p>
                    </div>
                @endforelse
            </div>
            <!-- start of image with titlt -->
        </div>
    </section>
@endsection