<!--<section class="container">-->
<!--      <div class="herosection row">-->
<!--        <div class="herosection_image-container col-md-12">-->
<!--          <img src="../image/about/contacthero.png" alt="" srcset="" />-->
<!--        </div>-->
<!--        <span class="section-overlay d-flex flex-column align-items-center">-->
<!--          <h2>What are you searching for ?</h2>-->
<!--          <h3>lets take you query !</h3>-->
<!--          <form action="{{ route('blog.search') }}" method="GET" class="d-flex querytaking">-->
<!--            <input type="text" name="query" id="query" />-->
<!--            <input type="submit" value="Click me" class="blogsearchss">-->
<!--          </form>-->
<!--        </span>-->
<!--      </div>-->
<!--    </section>-->


    <!-- card section  -->
    <section class="container">
      <div class="d-flex flex-column justify-content-center my-5">
        <span
          class="d-flex flex-column justify-content-center align-items-center containertitle"
        >
          <h2 class="d-flex justify-content-center">
            YOUR JOURNEY WITH OUR BLOG
          </h2>
          <div class="titlelongerbanner">
            <p class="titleline"></p>
            <span class="titlebannertext">SACRED HIMALAYAN HONEY</span>
            <p class="titleline"></p>
          </div>
        </span>
        <div id="cardsSectioncontent" class="d-flex justify-content-center row py-2">
          @foreach($blogpostcategories as $post)
              <div class="card mx-4 cardcustom col-md-3 my-4 col-sm-11">
                  <div class="cardimage">
                      <img class="card-img-top" object-fit:cover;" src="{{ asset('uploads/blogpostcategory/' . $post->image) }}" alt="Card image cap" />
                  </div>
                  <div class="card-body">
                      <h5 class="card-title">{{ $post->title }}</h5>
                      <p class="card-text pb-2">
                          {{ Str::limit(strip_tags($post->content), 150) }}
                      </p>
                      <a href="{{ route('BlogDetail', $post->slug) }}" class="btn ">Read More</a>
                  </div>
              </div>
          @endforeach
      </div>
       
      </div>
    
    </section>