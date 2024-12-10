@extends('frontend.layouts.master')

@section('content')
    <!----------------------------------contact page start section ----------->

    <!-- hero section -->
    <section class="container">
        <div class="herosection row">
          <div class="herosection_image-container col-md-12">
            <img src="../image/about/contacthero.png" alt="" srcset="" />
          </div>
          <span class="section-overlay d-flex flex-column align-items-center">
            <h2>What are you searching for ?</h2>
            <!--<span class="col-8">Pará is a state of Brazil, located in northern Brazil and traversed-->
            <!--    by the lower Amazon River. It borders the Brazilian states of Amap Brazilian states of Amap Brazilian states of Amapá,northwest-->
            <!--</span>-->
          </span>
        </div>
    </section>

    <!-- hero contact form -->
    <section class="container">
        <div class="d-flex flex-column justify-content-center my-5 row">
            <span class="d-flex flex-column justify-content-center align-items-center containertitle">
                <h2 class="d-flex justify-content-center">Connect with Us</h2>
                <img src="../image/banner.png" alt="Banner Image" />
            </span>
            <div class="d-flex flex-column justify-content-center customconnectwithus row">
                <p class="my-4">
                   Connect with us to explore the mystical allure of Himalayan Mad Honey. Whether you have questions, want to place an order,
                   or simply want to learn more, we're here to help. Reach out to us and experience the sacred sweetness of the Himalayas..
                </p>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="customconnectwithus-innersection d-flex justify-content-between">
                    <div class="customconnectwithus-innersection-left col-md-5 col-md-5">
                        <form id="contactForm" class="form-horizontal" method="POST" action="{{ route('Contact.store') }}">
                            @csrf
                            <div class="customconnectwithus-innersection-left_inputcontainer d-flex flex-column ">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" placeholder="NAME" name="name"
                                    value="{{ old('name') }}" required>
                            </div>
                            <div class="customconnectwithus-innersection-left_inputcontainer d-flex flex-column ">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="EMAIL" name="email"
                                    value="{{ old('email') }}" required>
                            </div>
                            <div class="customconnectwithus-innersection-left_inputcontainer d-flex flex-column ">
                                <label for="phone_no">Contact Number</label>
                                <input type="tel" name="phone_no" class="form-control" id="phone_no"
                                    placeholder="Phone No." value="{{ old('phone_no') }}" required>
                            </div>
                            <div class="customconnectwithus-innersection-left_inputcontainer d-flex flex-column">
                                <label for="message">Message</label>
                                <textarea class="form-control message-box" rows="4" placeholder="MESSAGE" name="message" required>{{ old('message') }}</textarea>
                            </div>
                            <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}"></div> 
                            <div class="customconnectwithus-innersection-left_inputcontainer d-flex flex-column my-1">
                                <button type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                    <div class="customconnectwithus-innersection-right p-4 col-md-6">
                        <span>Feel free to connect with us through the contact details
                            provided below for any type of inquiry or to establish a
                            connection. We are here to assist you in a positive and helpful
                            manner.</span>
                            <div class="customconnectwithus-innersection-right-ourdetail my-4 p-4">
                                <h6>Contact</h6>
                                <div class="py-2">
                                  @if (!empty($sitesetting->office_contact))
                                    @php
                                      $officeContacts = json_decode($sitesetting->office_contact, true);
                                    @endphp
                                    @if (is_array($officeContacts))
                                      @foreach ($officeContacts as $contact)
                                        <div class="d-flex align-items-center">
                                          <i class="fa-solid fa-phone"></i><span class="px-2">{{ $contact }}</span>
                                        </div>
                                      @endforeach
                                    @else
                                      <div class="d-flex align-items-center">
                                        <i class="fa-solid fa-phone"></i><span class="px-2">{{ $sitesetting->office_contact }}</span>
                                      </div>
                                    @endif
                                  @endif
                                </div>
                                <div class="py-2">
                                  @if (!empty($sitesetting->office_email))
                                    @php
                                      $officeEmails = json_decode($sitesetting->office_email, true);
                                    @endphp
                                    @if (is_array($officeEmails))
                                      @foreach ($officeEmails as $email)
                                        <div class="d-flex align-items-center">
                                          <i class="fa-solid fa-envelope"></i><span class="px-2">{{ $email }}</span>
                                        </div>
                                      @endforeach
                                    @else
                                      <div class="d-flex align-items-center">
                                        <i class="fa-solid fa-envelope"></i><span class="px-2">{{ $sitesetting->office_email }}</span>
                                      </div>
                                    @endif
                                  @endif
                                </div>
                              </div>
                              
                              <div class="customconnectwithus-innersection-right-ourdetail my-3 p-4">
                                <h6>Address</h6>
                                <div class="py-2">
                                  @if (!empty($sitesetting->office_address))
                                    @php
                                      $officeAddresses = json_decode($sitesetting->office_address, true);
                                    @endphp
                                    @if (is_array($officeAddresses))
                                      @foreach ($officeAddresses as $address)
                                        <div class="d-flex align-items-start">
                                          <i class="fa-solid fa-location-dot"></i>
                                          <span class="px-2">{{ $address }}</span>
                                        </div>
                                      @endforeach
                                    @else
                                      <div class="d-flex align-items-start">
                                        <i class="fa-solid fa-location-dot"></i>
                                        <span class="px-2">{{ $sitesetting->office_address }}</span>
                                      </div>
                                    @endif
                                  @endif
                                </div>
                              </div>
                              
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script>
        document.getElementById('contactForm').addEventListener('submit', function(event) {
            var response = grecaptcha.getResponse();
            if(response.length == 0) { 
                //reCaptcha not verified
                event.preventDefault();
                alert("Please verify that you are not a robot.");
            }
        });
    </script>
@endsection