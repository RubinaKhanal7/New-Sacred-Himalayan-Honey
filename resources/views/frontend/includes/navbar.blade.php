<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Your Page Title</title>
  <link rel="stylesheet" href="path/to/bootstrap.css">
  <style>
    .logo-link {
      text-decoration: none;
      color: inherit; 
    }
    /* Sticky navbar */
    .navcustom {
      position: sticky;
      top: 0;
      z-index: 1000;
      background-color: #ffffff;
    }
    /* Active link style */
    .navbar-nav .nav-link.active {
      font-weight: bold;
      color: #007bff; /* Bootstrap primary color, adjust as needed */
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light navcustom">
    <div class="container">
      <span class="navbar-brand">
        <div class="logoimage">
          <a href="{{ route('Index') }}" class="logo-link"><img src="{{asset('image/Logo.png')}}" alt="Logo Image" /></a>
        </div>
      </span>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav m-auto mb-2 mb-lg-0">
          <li class="nav-item mx-2">
            <a class="nav-link" href="{{ route('Index') }}" data-route="Index">Home</a>
          </li>
          <li class="nav-item mx-2">
            <a class="nav-link" href="{{ route('About') }}" data-route="About">Introduction</a>
          </li>
          <li class="nav-item mx-2">
            <a class="nav-link" href="{{ route('Product') }}" data-route="Product">Product</a>
          </li>
          <li class="nav-item mx-2">
            <a class="nav-link" href="{{ route('Blog') }}" data-route="Blog">Blog</a>
          </li>
          <li class="nav-item mx-2">
            <a class="nav-link" href="{{ route('Contact') }}" data-route="Contact">Contact</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <script src="path/to/bootstrap.bundle.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Function to set active link
      function setActiveLink() {
        let currentRoute = '{{ Route::currentRouteName() }}';
        let navLinks = document.querySelectorAll('.navbar-nav .nav-link');
        
        navLinks.forEach(link => {
          let linkRoute = link.getAttribute('data-route');
          if (linkRoute === currentRoute) {
            link.classList.add('active');
          } else {
            link.classList.remove('active');
          }
        });
      }

      // Call the function when the page loads
      setActiveLink();
    });
  </script>
</body>
</html>