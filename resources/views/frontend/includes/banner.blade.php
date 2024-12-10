<section class="container">
  <div class="herosectionindexpage d-flex justify-content-center align-items-center">
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
        @foreach($coverimages as $key => $coverimage)
          <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
            <div class="row py-1 px-5 align-items-center">
              <div class="col-md-6 col-sm-12 d-flex justify-content-center align-items-center flex-column order-md-1 order-2">
                <span class="d-flex justify-content-center align-items-start text-center col-md-8">
                  {{ $coverimage->title }}
                </span>
                <button class="buynow"><a class="no-text-decoration text-white" href="{{ route('Product') }}">Buy Now</a></button>
              </div>
              <div class="col-md-6  col-sm-12 heroimageindex order-md-2 order-1">
                <img src="{{ asset('uploads/coverimage/' . $coverimage->image) }}" alt="{{ $coverimage->title }}" class="img-fluid"/>
              </div>
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
  {{--
  
//   <script>
//     document.querySelector('.buynow').addEventListener('click', function() {
//         window.location.href = "{{ route('Product') }}";
//     });
//   </script>
--}}
</section>

