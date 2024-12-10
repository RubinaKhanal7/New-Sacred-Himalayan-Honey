
<section class="container-fluid">
  <div class="topimageforeverysectionstart">
    <img src="{{ asset('image/branchhive.png') }}" alt="Top Image">
  </div>
  <div class="aboutherosection container-fluid my-5">
    @foreach($about as $about)
    <div class="row customherosection container d-flex ">
      <h2>{{ $about->title }}</h2>
      <div class="col-md-7 order-md-1 order-2 col-sm-12 py-2">
        <p class="commondescription">
          {{ $about->description }}
        </p>
      </div>
      <div class="imagesection col-md-5 order-md-2 order-1 col-sm-12 col-1">
        <img src="{{ asset('uploads/about/' . $about->image) }}" alt="Hero Image" />
      </div>
    </div>
    @endforeach
  </div>
</section>

