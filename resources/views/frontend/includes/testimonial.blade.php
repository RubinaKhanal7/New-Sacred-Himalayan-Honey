<!-- Testimonials Start -->
{{-- <section class="container">
  <div class="customsection customsection_testimonial pt-3 mt-4">
      <div class="titlebannnersection py-4">
          <span class="d-flex flex-column justify-content-center align-items-center containertitle">
              <h2 class="d-flex justify-content-center">" Testimonials "</h2>
          </span>
      </div>
      <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
              @foreach ($testimonials->chunk(2) as $testimonialChunk)
                  <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                      <div class="row">
                          @foreach ($testimonialChunk as $testimonial)
                              <div class="col-md-6">
                                  <div class="testimonialhome d-flex flex-column align-items-center">
                                      <span class="pb-3 text-center">
                                          "{{ Str::limit($testimonial->description, 200) }}"
                                      </span>
                                      <div class="testimonialperson d-flex">
                                          <img src="{{ asset('uploads/testimonial/' . $testimonial->image) }}" alt="{{ $testimonial->name }}" />
                                         
                                               
                                      
                                      </div>
                                       <span class="personname">{{ $testimonial->name }}</span>
                                     
                                  </div>
                              </div>
                          @endforeach
                      </div>
                  </div>
              @endforeach
          </div>
    
          <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
          </a>
      </div>
  </div>
</section>
--}}









<section class="container">
     <div class="customsection customsection_testimonial pt-3 mt-4">
      <div class="titlebannnersection py-2">
          <span class="d-flex flex-column justify-content-center align-items-center containertitle">
              <h2 class="d-flex justify-content-center">" Testimonials "</h2>
             <div class="titlelongerbanner">
          <p class="titleline"></p>
          <span class="titlebannertext">SACRED HIMALAYAN HONEY</span>
          <p class="titleline"></p>
        </div>
          </span>
      </div>
  <div class=" d-flex justify-content-center align-items-center">
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
         @foreach ($testimonials->chunk(2) as $testimonialChunk)
                  <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                      <div class="row">
                          @foreach ($testimonialChunk as $testimonial)
                              <div class="col-md-6">
                                  <div class="testimonialhome d-flex flex-column align-items-center">
                                      <span class="pb-3 commondescription text-center">
                                          "{{ Str::limit($testimonial->description, 800) }}"
                                      </span>
                                      <div class="testimonialperson d-flex">
                                          <img src="{{ asset('uploads/testimonial/' . $testimonial->image) }}" alt="{{ $testimonial->name }}" />
                                         
                                               
                                      
                                      </div>
                                       <span class="personname">{{ $testimonial->name }}</span>
                                     
                                  </div>
                              </div>
                          @endforeach
                      </div>
                  </div>
              @endforeach
      </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    
    </div>
  
  </div>
  
</section>













 <!--Testimonials End -->
