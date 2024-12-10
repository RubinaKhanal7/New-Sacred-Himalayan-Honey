<x-guest-layout>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>{{ env('APP_NAME') }} Login</title>
        <link rel="stylesheet" href="{{ asset('adminassets/assets/bootstrap/dist/css/bootstrap.min.css') }}" />
        <style>
            .main {
                display: flex;
                justify-content: center;
                align-items: center;
                min-height: 100vh;
            }
            .recaptcha-wrapper {
                display: flex;
                justify-content: center;
                margin-bottom: 20px;
            }
            .alert {
                display: block;
                margin-top: 10px;
            }
            .card {
                border-radius: 0.5rem;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
                max-width: 800px;
                width: 100%;
            }
            .bg-holder {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-repeat: no-repeat;
                background-position: center;
                opacity: 0.1;
            }
            .bg-auth-card-shape {
                background-image: url('{{ asset('adminassets/assets/img/icons/spot-illustrations/half-circle.png') }}');
            }
            .form-label {
                font-weight: bold;
            }
            .text-danger {
                color: #dc3545 !important;
            }
            .btn-primary {
                background-color: #bb7030;
                border-color: #bb7030;
            }
            .btn-link {
                color: #bb7030;
            }
            .position-relative {
                position: relative;
            }
            .flex-center {
                display: flex;
                justify-content: center;
                align-items: center;
            }
            .overflow-hidden {
                overflow: hidden;
            }
            .z-index-1 {
                z-index: 1;
            }
            .error-message {
                color: #dc3545;
                margin-top: 5px;
            }
        </style>
    </head>
    <body>
        <main class="main" id="top">
            <div class="container">
                <div class="row flex-center g-0">
                    <div class="col-lg-10 col-xxl-8 position-relative">
                        <div class="card overflow-hidden z-index-1">
                            <div class="card-body p-0">
                                <div class="row g-0 h-100">
                                    <div class="col-md-5 text-center" style="background-color: #bb7030;">
                                        <div class="position-relative pt-md-5 pb-md-7 light">
                                            <div class="bg-holder bg-auth-card-shape"></div>
                                            <div class="z-index-1 position-relative">
                                                <img height="300" width="300" src="{{ asset('image/Sacred.png') }}" alt="Sacred Himalayan Honey">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-7 d-flex flex-center">
                                        <div class="p-4 p-md-5 flex-grow-1">
                                            <h3>{{ __('Account Login') }}</h3>
                                            
                                            @if(session('success'))
                                            <div class="alert alert-success">
                                                {{ session('success') }}
                                            </div>
                                            @endif
                                            
                                            @if($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            @endif

                                            <x-auth-session-status class="mb-4" :status="session('status')" />
                                            
                                            <form id="loginForm" method="POST" action="{{ route('login') }}">
                                                @csrf
                                                <div class="mb-3">
                                                    <x-input-label class="form-label" for="email" :value="__('Email')" />
                                                    <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                                </div>
                                                <div class="mb-3">
                                                    <x-input-label class="form-label" for="password" :value="__('Password')" />
                                                    <x-text-input id="password" class="form-control" type="password" name="password" required autocomplete="current-password" />
                                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                                </div>
                                                <div class="row flex-between-center mb-3">
                                                    <div class="col-auto">
                                                        <div class="form-check mb-0">
                                                            <input class="form-check-input" type="checkbox" id="remember_me" name="remember">
                                                            <label class="form-check-label mb-0" for="remember_me">{{ __('Remember me') }}</label>
                                                        </div>
                                                    </div>
                                                    @if (Route::has('password.request'))
                                                        <div class="col-auto">
                                                            <a class="fs--1" href="{{ route('password.request') }}">
                                                                {{ __('Forgot your password?') }}
                                                            </a>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="recaptcha-wrapper">
                                                    <div id="recaptcha-container"></div>
                                                </div>
                                                <div class="alert alert-danger d-none" id="recaptchaAlert" role="alert">
                                                    Please verify that you are not a robot.
                                                </div>
                                                <div class="mb-3">
                                                    <button class="btn btn-primary d-block w-100" type="submit" style="background-color: #bb7030; border-color:#bb7030">{{ __('Log in') }}</button>
                                                </div>
                                            </form>
                                            <div class="text-center mt-3">
                                                <p>{{ __("Don't have an account?") }} <a href="{{ route('register') }}">{{ __('Register') }}</a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        
        <script src="https://www.google.com/recaptcha/api.js?onload=onRecaptchaLoad&render=explicit" async defer></script>
        
        <script>
            var recaptchaWidget;
            var loginForm = document.getElementById('loginForm');
            var submitButton = loginForm.querySelector('button[type="submit"]');
            var recaptchaAlert = document.getElementById('recaptchaAlert');
    
            function onRecaptchaLoad() {
                recaptchaWidget = grecaptcha.render('recaptcha-container', {
                    'sitekey': '{{ config('services.recaptcha.site_key') }}',
                    'callback': onRecaptchaSuccess,
                    'expired-callback': onRecaptchaExpired
                });
                submitButton.disabled = true;
            }
    
            function onRecaptchaSuccess() {
                submitButton.disabled = false;
                recaptchaAlert.classList.add('d-none');
            }
    
            function onRecaptchaExpired() {
                submitButton.disabled = true;
                recaptchaAlert.textContent = 'reCAPTCHA has expired. Please solve it again.';
                recaptchaAlert.classList.remove('d-none');
            }
    
            loginForm.addEventListener('submit', function(event) {
                var recaptchaResponse = grecaptcha.getResponse(recaptchaWidget);
                
                if (!recaptchaResponse) {
                    event.preventDefault();
                    recaptchaAlert.textContent = 'Please verify that you are not a robot.';
                    recaptchaAlert.classList.remove('d-none');
                } else {
                    recaptchaAlert.classList.add('d-none');
                }
            });
    
            document.addEventListener('DOMContentLoaded', function() {
                const loginForm = document.getElementById('loginForm');
                if (loginForm) {
                    loginForm.addEventListener('submit', function(e) {
                        e.preventDefault();
                        const formData = new FormData(loginForm);
                        const intendedPaymentRoute = sessionStorage.getItem('intendedPaymentRoute');
                        if (intendedPaymentRoute) {
                            formData.append('redirect', intendedPaymentRoute);
                        }
    
                        fetch(loginForm.action, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'application/json',
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                const quantity = sessionStorage.getItem('quantity');
                                const totalPrice = sessionStorage.getItem('totalPrice');
                                window.location.href = `${data.redirect}?quantity=${quantity}&totalPrice=${totalPrice}`;
                                sessionStorage.removeItem('intendedPaymentRoute');
                                sessionStorage.removeItem('quantity');
                                sessionStorage.removeItem('totalPrice');
                            } else {
                                // Display error messages
                                let errorHtml = '<div class="alert alert-danger"><ul>';
                                for (let field in data.errors) {
                                    data.errors[field].forEach(error => {
                                        errorHtml += `<li>${error}</li>`;
                                    });
                                }
                                errorHtml += '</ul></div>';
                                loginForm.insertAdjacentHTML('beforebegin', errorHtml);
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            loginForm.insertAdjacentHTML('beforebegin', '<div class="alert alert-danger">An unexpected error occurred. Please try again.</div>');
                        });
                    });
                }
            });
        </script>
    </body>
    </html>
</x-guest-layout>