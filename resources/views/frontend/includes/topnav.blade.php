<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="path/to/font-awesome.css">
    <link rel="stylesheet" href="path/to/your-stylesheet.css">

    <style>
        .whole-nav {
            position: sticky;
            top: 0;
            z-index: 1000;
            background-color: #ffffff;
        }
        .icons-collection a {
            text-decoration: none;
            color: inherit;
        }
        .authorization-section {
            display: flex;
            align-items: center;
        }
        .user-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #774421;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 20px;
        }
        .cart {
            background: none;
            border: none;
            cursor: pointer;
        }
        .welcome-message {
            color: #774421;
            margin-right: 10px;
        }
        .popup-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1010;
            justify-content: center;
            align-items: center;
        }
        .popup {
            background-color: white;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            width: 300px;
            z-index: 1001;
            text-align: center;
        }
        .popup-content {
            display: flex;
            flex-direction: column;
        }
        .popup-content a {
            color: #774421;
            text-decoration: none;
            padding: 10px 20px;
            font-size: 16px;
        }
        .popup-content a:hover {
            background-color: #f0f0f0;
        }
        .close-button {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #774421;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <section class="container whole-nav">
        <div id="topsection">
            <div class="top-nav">
                <div class="icons-collection">
                    <a href="{{ $sitesetting->facebook_link }}">
                        <i class="fa-brands fa-facebook"></i>
                    </a>
                    <!--<a href="{{ $sitesetting->linkedin_link }}">-->
                    <!--    <i class="fa-brands fa-linkedin"></i>-->
                    <!--</a>-->
                    <a href="{{ $sitesetting->instagram_link }}">
                        <i class="fa-brands fa-instagram"></i>
                    </a>
                </div>
                <div class="authorization-section">
                    @guest
                        <form action="{{ route('register') }}" method="get" style="display: inline;">
                            <button type="submit" class="register">Register</button>
                        </form>
                        <form action="{{ route('login') }}" method="get" style="display: inline;">
                            <button type="submit" class="login">Login</button>
                        </form>
                    @else
                        <span class="welcome-message">Welcome, {{ Auth::user()->name }}</span>
                        <div class="user-icon" onclick="togglePopup()">
                            <i class="fa fa-user"></i>
                        </div>
                    @endguest
                    <a href="{{ route('Catalog') }}" class="cart-icon-wrapper">
                        <button class="cart">
                            <i class="fa-solid fa-cart-shopping"></i>
                            <span id="cartCount">0</span>
                        </button>
                    </a>
                </div>
            </div>
            <div class="spaceline"></div>
        </div>
    </section>

    <div class="popup-overlay" id="popupOverlay">
        <div class="popup" id="popup">
            <div class="popup-content">
                <a href="{{ route('profile') }}">Profile</a>
                <a href="#" onclick="event.preventDefault(); confirmLogout();">Logout</a>
                <button class="close-button" onclick="closePopup()">Close</button>
            </div>
        </div>
    </div>

    <script>
    function confirmLogout() {
        if (confirm("Are you sure you want to logout?")) {
            document.getElementById('logout-form').submit();
        }
    }

    function togglePopup() {
        var popupOverlay = document.getElementById('popupOverlay');
        popupOverlay.style.display = popupOverlay.style.display === 'flex' ? 'none' : 'flex';
    }

    function closePopup() {
        document.getElementById('popupOverlay').style.display = 'none';
    }

    // Close popup when clicking outside
    document.addEventListener('click', function(e) {
        var popupOverlay = document.getElementById('popupOverlay');
        var userIcon = document.querySelector('.user-icon');
        if (!userIcon.contains(e.target) && !document.getElementById('popup').contains(e.target)) {
            popupOverlay.style.display = 'none';
        }
    });
    </script>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</body>
</html>
