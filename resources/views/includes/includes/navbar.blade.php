<nav class="navbar navbar-light navbar-glass navbar-top navbar-expand navbar-glass-shadow">
    <button class="btn navbar-toggler-humburger-icon navbar-toggler me-1 me-sm-3" type="button" data-bs-toggle="collapse"
        data-bs-target="#navbarVerticalCollapse" aria-controls="navbarVerticalCollapse" aria-expanded="false"
        aria-label="Toggle Navigation"><span class="navbar-toggle-icon"><span class="toggle-line"></span></span></button>
    <a class="navbar-brand me-1 me-sm-3" href="index.html">
        <div class="d-flex align-items-center"><img class="me-2" src="assets/img/icons/spot-illustrations/falcon.png"
                alt="" width="40"><span class="font-sans-serif">falcon</span></div>
    </a>
    <ul class="navbar-nav navbar-nav-icons ms-auto flex-row align-items-center">
        <li class="nav-item">
            <div class="theme-control-toggle fa-icon-wait px-2"><input
                    class="form-check-input ms-0 theme-control-toggle-input" id="themeControlToggle" type="checkbox"
                    data-theme-control="theme" value="dark"><label
                    class="mb-0 theme-control-toggle-label theme-control-toggle-light" for="themeControlToggle"
                    data-bs-toggle="tooltip" data-bs-placement="left" aria-label="Switch to light theme"
                    data-bs-original-title="Switch to light theme"><svg class="svg-inline--fa fa-sun fa-w-16 fs-0"
                        aria-hidden="true" focusable="false" data-prefix="fas" data-icon="sun" role="img"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                        <path fill="currentColor"
                            d="M256 160c-52.9 0-96 43.1-96 96s43.1 96 96 96 96-43.1 96-96-43.1-96-96-96zm246.4 80.5l-94.7-47.3 33.5-100.4c4.5-13.6-8.4-26.5-21.9-21.9l-100.4 33.5-47.4-94.8c-6.4-12.8-24.6-12.8-31 0l-47.3 94.7L92.7 70.8c-13.6-4.5-26.5 8.4-21.9 21.9l33.5 100.4-94.7 47.4c-12.8 6.4-12.8 24.6 0 31l94.7 47.3-33.5 100.5c-4.5 13.6 8.4 26.5 21.9 21.9l100.4-33.5 47.3 94.7c6.4 12.8 24.6 12.8 31 0l47.3-94.7 100.4 33.5c13.6 4.5 26.5-8.4 21.9-21.9l-33.5-100.4 94.7-47.3c13-6.5 13-24.7.2-31.1zm-155.9 106c-49.9 49.9-131.1 49.9-181 0-49.9-49.9-49.9-131.1 0-181 49.9-49.9 131.1-49.9 181 0 49.9 49.9 49.9 131.1 0 181z">
                        </path>
                    </svg><!-- <span class="fas fa-sun fs-0"></span> Font Awesome fontawesome.com --></label>
                <label class="mb-0 theme-control-toggle-label theme-control-toggle-dark" for="themeControlToggle"
                    data-bs-toggle="tooltip" data-bs-placement="left" aria-label="Switch to dark theme"
                    data-bs-original-title="Switch to dark theme">
                    <span class="fas fa-moon fs-0"></span>
                </label>


            </div>

        </li>


        <li class="nav-item">
            <div class="role-name">
                {{-- <div class="role-name">{{ $roleNames }}</div> --}}
                {{-- <div class="user-email">{{ Auth::user()->email }}</div> --}}
            </div>

        </li>


        <li class="nav-item dropdown"><a class="nav-link pe-0 ps-2" id="navbarDropdownUser" role="button"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                <div class="avatar-container">
                    <div class="avatar avatar-xl">
                        <img class="rounded-circle" alt="profile">
                    </div>
                  
                </div>
                <div class="dropdown-menu dropdown-caret dropdown-caret dropdown-menu-end py-0"
                    aria-labelledby="navbarDropdownUser">
                    <div class="bg-white dark__bg-1000 rounded-2 py-2">
                        <a class="dropdown-item" href="{{ route('password.request') }}">{{ __('Update Password') }}</a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('superadmin.logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
        </li>
    </ul>
</nav>
