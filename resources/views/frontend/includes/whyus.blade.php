<section class="container-fluid">
     <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 246">
        <path fill="#fff6e6" fill-opacity="1"
          d="M0,160L120,181.3C240,203,480,245,720,245.3C960,245,1200,203,1320,181.3L1440,160L1440,320L1320,320C1200,320,960,320,720,320C480,320,240,320,120,320L0,320Z">
        </path>
      </svg>
    <div class="customsection whyusbackcolor py-5 ">
          <div class=container ">
        <div class="titlebannnersection text-center">
            <span class="d-flex flex-column justify-content-center align-items-center containertitle">
                <h2 class="d-flex justify-content-center">
                    Why Sacred Himalayan Honey
                </h2>
                <div class="titlelongerbanner">
                    <p class="titleline"></p>
                    <span class="titlebannertext">SACRED HIMALAYAN HONEY</span>
                    <p class="titleline"></p>
                </div>
            </span>
        </div>
        <div class="whyuscontainhome row justify-content-center">
            @foreach($whyus as $item)
                <div class="col-md-4 col-sm-8 d-flex flex-column align-items-center">
                    <div class="whyusimagecontainer">
                      <img src="{{ asset('uploads/whyus/' . $item->image) }}" alt="{{ $item->title }}" />
                    </div>
                    <h3 class="pt-2">{{ Str::limit($item->title, 100) }}</h3>
                    <span class="text-justify  commondescription "> {{ Str::limit($item->content,600) }}</span>
                </div>
            @endforeach
        </div>
    </div>
 </div>
</section>
