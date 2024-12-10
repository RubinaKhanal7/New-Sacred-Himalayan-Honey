@extends('frontend.layouts.master')

@section('content')
    <!----------------------------------About PAge Start --------------------------------------------------------------------------->
    <!----------------------------------hero section --------------------------------------------------------------------------->

@include('frontend.includes.about');

<!--why us section-->
{{-- <section class="container">
    <div class="whycardsection d-flex flex-column">
        @foreach($whyus as $item)
        <d iv class="row featurette d-flex justify-content-center align-items-center whyuscustomcard odd  my-1">
            <div class="col-md-6 order-md-{{ $loop->odd ? '1' : '2' }} order-2">
                <h3 class="featurette-heading fw-normal lh-5 py-1">
                    {{ $item->title }}
                </h3>
                <p class="commondescription">
                    {{ $item->content }}
                </p>
                <div class="highlight-words">
                    @foreach(explode(',', $item->highlights) as $highlight)
                    <span class="highlight">{{ $highlight }}</span>
                    @endforeach
                </div>
            </div>
            <div class="col-md-5 col-xs-12 order-md-{{ $loop->odd ? '2' : '1' }} order-1 whyusimage">
                <img src="{{ asset('uploads/whyus/' . $item->image) }}" alt="{{ $item->title }}" class="" />
            </div>
        </div>
        @endforeach
    </div>
</section>
--}}




<section class="container-fluid">
    <div class="customsection ">
          <div class=container ">
        <!--<div class="titlebannnersection text-center">-->
        <!--    <span class="d-flex flex-column justify-content-center align-items-center containertitle">-->
        <!--        <h2 class="d-flex justify-content-center">-->
        <!--            Why Sacred Himalayan Honey-->
        <!--        </h2>-->
        <!--        <div class="titlelongerbanner">-->
        <!--            <p class="titleline"></p>-->
        <!--            <span class="titlebannertext">SACRED HIMALAYAN HONEY</span>-->
        <!--            <p class="titleline"></p>-->
        <!--        </div>-->
        <!--    </span>-->
        <!--</div>-->
        <div class="whyuscontainhome row justify-content-center py-3">
            @foreach($whyus as $item)
                <div class="col-md-4 col-sm-8 d-flex flex-column align-items-center py-3">
                    <div class="whyusimagecontainer">
                      <img src="{{ asset('uploads/whyus/' . $item->image) }}" alt="{{ $item->title }}" />
                    </div>
                    <h3 class="pt-2">{{ Str::limit($item->title, 100) }}</h3>
                    <span class="text-justify  commondescription "> {{ Str::limit($item->content, 700) }}</span>
                </div>
            @endforeach
        </div>
    </div>
 </div>
</section>
















{{--
    <section class="container">
      <div class="companydetail">
        <div class="row d-flex py-4">
          <div class="leftcontent col-3" id="rightsite">
            <div
              class="circle d-flex flex-column justify-content-between align-items-center"
            >
              <span class="titledefine" id="mission" onclick="funDetail(this)">
                Mission
              </span>
              <img src="../image/about/Vector.png" alt="" srcset="" />
            </div>
            <div
              class="circle d-flex flex-column justify-content-between align-items-center"
            >
              <span class="titledefine" id="plan" onclick="funDetail(this)">
                plan
              </span>
              <img src="../image/about/Vector.png" alt="" srcset="" />
            </div>
            <div
              class="circle d-flex flex-column justify-content-between align-items-center"
            >
              <span class="titledefine" id="Vision" onclick="funDetail(this)">
                Vision
              </span>
              <img src="../image/about/Vector.png" alt="" srcset="" />
            </div>
            <div
              class="circle d-flex flex-column justify-content-between align-items-center"
            >
              <span class="titledefine" id="goal" onclick="funDetail(this)">
                goal</span
              >
            </div>
          </div>

        

          <div class="col-6 description" id="companydescription">
            <h2 class="my-4">Company Description</h2>
            <div
              class="descriptiondetail d-flex align-items-center text-center pb-2 my-4"
            >
              <i class="fa-regular fa-circle-check"></i>
              <h5 class="highlightpoints px-3">Company Name :</h5>

              <span>{{ $sitesetting->office_name }}</span>
            </div>
            <div
              class="descriptiondetail d-flex align-items-center text-center pb-2 my-4"
            >
              <i class="fa-regular fa-circle-check"></i>
              <h5 class="highlightpoints px-3">Company Address :</h5>
              <span>@if (!empty($sitesetting->office_address))
                @php
                    $officeAddresses = json_decode($sitesetting->office_address, true);
                @endphp
                @if (is_array($officeAddresses))
                    @foreach ($officeAddresses as $address)
                        {{ $address }} <br>
                    @endforeach
                @else
                    {{ $sitesetting->office_address }} <br>
                @endif
            @endif</span>
            </div>
         
            <div
              class="descriptiondetail d-flex align-items-center text-center pb-2 my-4"
            >
              <i class="fa-regular fa-circle-check"></i>
              <h5 class="highlightpoints px-3">Contact Number :</h5>
              <span>
                @if (!empty($sitesetting->office_contact))
                @php
                    $officeContacts = json_decode($sitesetting->office_contact, true);
                @endphp
                @if (is_array($officeContacts))
                    @foreach ($officeContacts as $contact)
                        {{ $contact }} <br>
                    @endforeach
                @else
                    {{ $sitesetting->office_contact }} <br>
                @endif
            @endif
                </span>
            </div>
            <div
              class="descriptiondetail d-flex align-items-center text-center pb-2 my-4"
            >
              <i class="fa-regular fa-circle-check"></i>
              <h5 class="highlightpoints px-3">Established Date :</h5>
              <span>{{ $sitesetting->company_registered_date }}</span>
            </div>
            <div
              class="descriptiondetail d-flex align-items-center text-center pb-2 my-4"
            >
              <i class="fa-regular fa-circle-check"></i>
              <h5 class="highlightpoints px-3">Company Email :</h5>
              <span>  
                @if (!empty($sitesetting->office_email))
                @php
                    $officeEmails = json_decode($sitesetting->office_email, true);
                @endphp
                @if (is_array($officeEmails))
                    @foreach ($officeEmails as $email)
                        {{ $email }} <br>
                    @endforeach
                @else
                    {{ $sitesetting->office_email }} <br>
                @endif
            @endif</span>
            </div>

          <!-- mission description -->

          <div
            class="col-6 description description_particular"
            id="missiondescription"
          >
            <h2 class="my-4">Company Mission</h2>
            <div
              class="descriptiondetail d-flex align-items-center justify-content-start pb-2 my-4"
            >
              <i
                class="fa-regular fa-circle-check d-flex justify-content-start align-items-start text-start"
              ></i>
              <span
                >embarking on an odyssey through the digital landscape of
              </span>
            </div>
            <div
              class="descriptiondetail d-flex align-items-center text-center pb-2 my-4"
            >
              <i class="fa-regular fa-circle-check"></i>
              <span
                >embarking on an odyssey through the digital landscape of</span
              >
            </div>
            <div
              class="descriptiondetail d-flex align-items-center text-center pb-2 my-4"
            >
              <i class="fa-regular fa-circle-check"></i>
              <span
                >embarking on an odyssey through the digital landscape of</span
              >
            </div>
            <div
              class="descriptiondetail d-flex align-items-center text-center pb-2 my-4"
            >
              <i class="fa-regular fa-circle-check"></i>
              <span>2002-september-29 mbarking on an odyssey through the</span>
            </div>
            <div
              class="descriptiondetail d-flex align-items-center text-center pb-2 my-4"
            >
              <i class="fa-regular fa-circle-check"></i>
              <span
                >Sacred Himalayan Honey mbarking on an odyssey through the</span
              >
            </div>
            <div
              class="descriptiondetail d-flex align-items-center text-center pb-2 my-4"
            >
              <i class="fa-regular fa-circle-check"></i>
              <span
                >Sacred Himalayan Honey mbarking on an odyssey through the</span
              >
            </div>
            <div
              class="descriptiondetail d-flex align-items-center text-center pb-2 my-4"
            >
              <i class="fa-regular fa-circle-check"></i>
              <span>Sacred Himalayan Hone y</span>
            </div>
          </div>

          <!-- plan description -->

          <div
            class="col-6 description description_particular"
            id="plandescription"
          >
            <h2 class="my-4">Company Plan</h2>
            <div
              class="descriptiondetail d-flex align-items-center justify-content-start pb-2 my-4"
            >
              <i
                class="fa-regular fa-circle-check d-flex justify-content-start align-items-start text-start"
              ></i>
              <span
                >embarking on an odyssey through the digital landscape of
              </span>
            </div>
            <div
              class="descriptiondetail d-flex align-items-center text-center pb-2 my-4"
            >
              <i class="fa-regular fa-circle-check"></i>
              <span
                >embarking on an odyssey through the digital landscape of</span
              >
            </div>
            <div
              class="descriptiondetail d-flex align-items-center text-center pb-2 my-4"
            >
              <i class="fa-regular fa-circle-check"></i>
              <span
                >embarking on an odyssey through the digital landscape of</span
              >
            </div>
            <div
              class="descriptiondetail d-flex align-items-center text-center pb-2 my-4"
            >
              <i class="fa-regular fa-circle-check"></i>
              <span>2002-september-29 mbarking on an odyssey through the</span>
            </div>
            <div
              class="descriptiondetail d-flex align-items-center text-center pb-2 my-4"
            >
              <i class="fa-regular fa-circle-check"></i>
              <span
                >Sacred Himalayan Honey mbarking on an odyssey through the</span
              >
            </div>
            <div
              class="descriptiondetail d-flex align-items-center text-center pb-2 my-4"
            >
              <i class="fa-regular fa-circle-check"></i>
              <span
                >Sacred Himalayan Honey mbarking on an odyssey through the</span
              >
            </div>
            <div
              class="descriptiondetail d-flex align-items-center text-center pb-2 my-4"
            >
              <i class="fa-regular fa-circle-check"></i>
              <span>Sacred Himalayan Hone y</span>
            </div>
          </div>

          <!-- vision description -->

          <div
            class="col-6 description description_particular"
            id="visiondescription"
          >
            <h2 class="my-4">Company vision</h2>
            <div
              class="descriptiondetail d-flex align-items-center justify-content-start pb-2 my-4"
            >
              <i
                class="fa-regular fa-circle-check d-flex justify-content-start align-items-start text-start"
              ></i>
              <span
                >embarking on an odyssey through the digital landscape of
              </span>
            </div>
            <div
              class="descriptiondetail d-flex align-items-center text-center pb-2 my-4"
            >
              <i class="fa-regular fa-circle-check"></i>
              <span
                >embarking on an odyssey through the digital landscape of</span
              >
            </div>
            <div
              class="descriptiondetail d-flex align-items-center text-center pb-2 my-4"
            >
              <i class="fa-regular fa-circle-check"></i>
              <span
                >embarking on an odyssey through the digital landscape of</span
              >
            </div>
            <div
              class="descriptiondetail d-flex align-items-center text-center pb-2 my-4"
            >
              <i class="fa-regular fa-circle-check"></i>
              <span>2002-september-29 mbarking on an odyssey through the</span>
            </div>
            <div
              class="descriptiondetail d-flex align-items-center text-center pb-2 my-4"
            >
              <i class="fa-regular fa-circle-check"></i>
              <span
                >Sacred Himalayan Honey mbarking on an odyssey through the</span
              >
            </div>
            <div
              class="descriptiondetail d-flex align-items-center text-center pb-2 my-4"
            >
              <i class="fa-regular fa-circle-check"></i>
              <span
                >Sacred Himalayan Honey mbarking on an odyssey through the</span
              >
            </div>
            <div
              class="descriptiondetail d-flex align-items-center text-center pb-2 my-4"
            >
              <i class="fa-regular fa-circle-check"></i>
              <span>Sacred Himalayan Hone y</span>
            </div>
          </div>

          <!-- goal description -->

          <div
            class="col-6 description description_particular"
            id="goaldescription"
          >
            <h2 class="my-4">Company Goal</h2>
            <div
              class="descriptiondetail d-flex align-items-center justify-content-start pb-2 my-4"
            >
              <i
                class="fa-regular fa-circle-check d-flex justify-content-start align-items-start text-start"
              ></i>
              <span
                >embarking on an odyssey through the digital landscape of
              </span>
            </div>
            <div
              class="descriptiondetail d-flex align-items-center text-center pb-2 my-4"
            >
              <i class="fa-regular fa-circle-check"></i>
              <span
                >embarking on an odyssey through the digital landscape of</span
              >
            </div>
            <div
              class="descriptiondetail d-flex align-items-center text-center pb-2 my-4"
            >
              <i class="fa-regular fa-circle-check"></i>
              <span
                >embarking on an odyssey through the digital landscape of</span
              >
            </div>
            <div
              class="descriptiondetail d-flex align-items-center text-center pb-2 my-4"
            >
              <i class="fa-regular fa-circle-check"></i>
              <span>2002-september-29 mbarking on an odyssey through the</span>
            </div>
            <div
              class="descriptiondetail d-flex align-items-center text-center pb-2 my-4"
            >
              <i class="fa-regular fa-circle-check"></i>
              <span
                >Sacred Himalayan Honey mbarking on an odyssey through the</span
              >
            </div>
            <div
              class="descriptiondetail d-flex align-items-center text-center pb-2 my-4"
            >
              <i class="fa-regular fa-circle-check"></i>
              <span
                >Sacred Himalayan Honey mbarking on an odyssey through the</span
              >
            </div>
            <div
              class="descriptiondetail d-flex align-items-center text-center pb-2 my-4"
            >
              <i class="fa-regular fa-circle-check"></i>
              <span>Sacred Himalayan Hone y</span>
            </div>
          </div>
        </div>
      </div>
    </section>
       <Style>
                @media (max-width:500px){
                    .descriptiondetail h5{
                          font-size:16px;
                          font-weight:600px;
                        
                    }
                    .descriptiondetail span{
                        font-size:14px;
                        
                    }
                }
            </Style>
            
            --}}


    <!----------------------------------branch section --------------------------------------------------------------------------->

    {{-- <section class="container py-5">
      <div class="row branchsection-custom-row">
        <span
          class="d-flex flex-column justify-content-center align-items-center containertitle mb-5"
        >
          <h2 class="d-flex justify-content-center">Our branch</h2>
          <img src="../image/banner.png" alt="" srcset="" />
        </span>
        <!-- col -->
        <div
          class="col-md-3 d-flex flex-column justify-content-between align-items-center py-4 custombranchcolumn"
        >
          <div class="branchimagesection">
            <img src="../image/about/chec.jpg" alt="" />
          </div>
          <div
            class="contentsection text-center align-items-center justify-content-between d-flex flex-column mt-5"
          >
            <div class="titlesection">
              <h4>Chabahil, Kathmandu</h4>
              <h4>Head Office</h4>
            </div>
            <div class="abouticoncollection">
              <i class="fa-brands fa-facebook"></i>
              <i class="fa-brands fa-linkedin"></i>
              <i class="fa-solid fa-envelope"></i>
            </div>
          </div>
        </div>
        <!-- col -->
        <div
          class="col-md-3 d-flex flex-column justify-content-between align-items-center py-4 custombranchcolumn"
        >
          <div class="branchimagesection">
            <img src="../image/about/branch.png" alt="" />
          </div>
          <div
            class="contentsection text-center align-items-center justify-content-between d-flex flex-column mt-5"
          >
            <div class="titlesection">
              <h4>Chabahil, Kathmandu</h4>
              <h4>Head Office</h4>
            </div>
            <div class="abouticoncollection">
              <i class="fa-brands fa-facebook"></i>
              <i class="fa-brands fa-linkedin"></i>
              <i class="fa-solid fa-envelope"></i>
            </div>
          </div>
        </div>
        <!-- col -->
        <div
          class="col-md-3 d-flex flex-column justify-content-between align-items-center py-4 custombranchcolumn"
        >
          <div class="branchimagesection">
            <img src="../image/about/branch.png" alt="" />
          </div>
          <div
            class="contentsection text-center align-items-center justify-content-between d-flex flex-column mt-5"
          >
            <div class="titlesection">
              <h4>Chabahil, Kathmandu</h4>
              <h4>Head Office</h4>
            </div>
            <div class="abouticoncollection">
              <i class="fa-brands fa-facebook"></i>
              <i class="fa-brands fa-linkedin"></i>
              <i class="fa-solid fa-envelope"></i>
            </div>
          </div>
        </div>
      </div>
    </section> --}}
    
    

   @endsection

    <!--<script>-->
    <!--  const companydescription = document.getElementById("companydescription");-->
    <!--  const GoalDescription = document.getElementById("goaldescription");-->
    <!--  const missionDescription = document.getElementById("missiondescription");-->
    <!--  const planDescription = document.getElementById("plandescription");-->
    <!--  const visionDescription = document.getElementById("visiondescription");-->

    <!--  function funDetail(element) {-->
    <!--    if (element.id === "mission") {-->
    <!--      missionDescription.style.display = "block";-->
    <!--      GoalDescription.style.display = "none";-->
    <!--      companydescription.style.display = "none";-->
    <!--      planDescription.style.display = "none";-->
    <!--      visionDescription.style.display = "none";-->
    <!--    } else if (element.id === "plan") {-->
    <!--      planDescription.style.display = "block";-->
    <!--      GoalDescription.style.display = "none";-->
    <!--      companydescription.style.display = "none";-->
    <!--      missionDescription.style.display = "none";-->
    <!--      visionDescription.style.display = "none";-->
    <!--    } else if (element.id === "Vision") {-->
    <!--      visionDescription.style.display = "block";-->
    <!--      GoalDescription.style.display = "none";-->
    <!--      companydescription.style.display = "none";-->
    <!--      missionDescription.style.display = "none";-->
    <!--      planDescription.style.display = "none";-->
    <!--    } else if (element.id === "goal") {-->
    <!--      GoalDescription.style.display = "block";-->
    <!--      companydescription.style.display = "none";-->
    <!--      missionDescription.style.display = "none";-->
    <!--      planDescription.style.display = "none";-->
    <!--      visionDescription.style.display = "none";-->
    <!--    } else {-->
    <!--      companydescription.style.display = "block";-->
    <!--      GoalDescription.style.display = "none";-->
    <!--      missionDescription.style.display = "none";-->
    <!--      planDescription.style.display = "none";-->
    <!--      visionDescription.style.display = "none";-->
    <!--    }-->
    <!--  }-->
    <!--</script>-->
