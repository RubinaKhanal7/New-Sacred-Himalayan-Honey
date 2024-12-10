<!----------------------------------footer section ---------------------------------------------------------------------------------->
<footer class="container-fluid">
    <div class="footer-top d-flex flex-column container justify-content-center py-5 ">
      <div class="footersection row">
        <div class="footersection-col col-md-3 col-5 d-flex flex-column py-2">
          <h5>Shop</h5>
          <ul class="footer-nav-link">
            @foreach ($products as $product)
              <li><a class="text-decoration-none text-white" href="#">{{ $product->product_name }}</a></li>
            @endforeach
          </ul>
        </div>
        <div class="footersection-col col-md-3 col-6 d-flex flex-column py-2">
          <h5>Why Us</h5>
          <ul>
            @foreach ($whyus as $whyus)
            <li>{{ $whyus->title }}
          @endforeach
          </ul>
        </div>
        <div class="footersection-col col-md-3 col-12 py-2">
          <h5>Customer Support</h5>
          <ul>
              @if (!empty($sitesetting->office_address))
                  @php
                      $officeAddresses = json_decode($sitesetting->office_address, true);
                  @endphp
                  @foreach ($officeAddresses as $address)
                      <li>
                          <span><i class="fa-solid fa-location-dot"></i></span>
                          <span>{{ $address }}</span>
                      </li>
                  @endforeach
              @endif
      
              @if (!empty($sitesetting->office_contact))
                  @php
                      $officeContacts = json_decode($sitesetting->office_contact, true);
                  @endphp
                  @foreach ($officeContacts as $contact)
                      <li>
                          <span><i class="fa-solid fa-phone"></i></span>
                          <span>{{ $contact }}</span>
                      </li>
                  @endforeach
              @endif
      
              @if (!empty($sitesetting->office_email))
                  @php
                      $officeEmails = json_decode($sitesetting->office_email, true);
                  @endphp
                  @foreach ($officeEmails as $email)
                      <li>
                          <span><i class="fa-solid fa-envelope"></i></span>
                          <span>{{ $email }}</span>
                      </li>
                  @endforeach
              @endif
          </ul>
      </div>
      
        <div class="footersection-col col-md-3 col-12 py-2">
          <div class="follow-section">
            <span>Get Connected</span>
            <div class="footer-icons-collection">
                <a href="{{ $sitesetting->facebook_link }}" style="text-decoration: none; color: inherit;">
                    <i class="fa-brands fa-facebook"></i>
                </a>
                <a href="{{ $sitesetting->linkedin_link }}" style="text-decoration: none; color: inherit;">
                    <i class="fa-brands fa-linkedin"></i>
                </a>
                <a href="{{ $sitesetting->instagram_link }}" style="text-decoration: none; color: inherit;">
                    <i class="fab fa-instagram"></i>
                </a>
            </div>
        </div>
        
        </div>
      </div>

      <div class="footerdivider"></div>
      <div class="d-flex justify-content-between container footerbottoncustom">
        <span>Copyright @ 2081 aashatech </span>
        <span>{{ $sitesetting->slogan }}</span>
      </div>
    </div>
  </footer>