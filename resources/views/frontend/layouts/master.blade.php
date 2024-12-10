
<!doctype html>

@include('frontend.includes.head')

<body>
    @include('frontend.includes.topnav')

@include('frontend.includes.navbar')



@yield('content')

@include('frontend.includes.footer')

<script>
    document.addEventListener("DOMContentLoaded", function () {
      const slider = document.querySelector(".slider");
      const slides = slider.querySelectorAll("img");
      const contentDescription = document.querySelector(
        ".effectcontentdescription"
      );
      let slideIndex = 0;
  
      // Show the first slide and content initially
      slides[slideIndex].classList.add("active");
      contentDescription.classList.add("active");
  
      // Set interval for image sliding
      setInterval(nextSlide, 3000); // Change slide every 3 seconds
  
      function nextSlide() {
        // Hide the current slide and content
        slides[slideIndex].classList.remove("active");
        contentDescription.classList.remove("active");
  
        slideIndex++;
        if (slideIndex >= slides.length) {
          slideIndex = 0;
        }
  
        // Show the next slide and content with animation
        slides[slideIndex].classList.add("active");
        contentDescription.classList.add("active");
      }
    });
  </script>
 <script>
  function addToCart(id, name, price) {
      let cart = JSON.parse(localStorage.getItem('cart') || '{}');
      if (cart[id]) {
          cart[id].quantity += 1;
      } else {
          cart[id] = {id: id, name: name, price: price, quantity: 1};
      }
      localStorage.setItem('cart', JSON.stringify(cart));
      updateCartCount();
      window.location.href = "{{ route('show', '') }}/" + id;
  }

  function updateCartCount() {
      let cart = JSON.parse(localStorage.getItem('cart') || '{}');
      let count = Object.values(cart).reduce((total, item) => total + item.quantity, 0);
      document.getElementById('cartCount').textContent = count;
  }

  // Call this when the page loads
  document.addEventListener('DOMContentLoaded', updateCartCount);
</script>

</body>
</html>

