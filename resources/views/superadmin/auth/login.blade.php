<x-guest-layout>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>{{ env('APP_NAME') }} Login</title>
        <link rel="stylesheet" href="{{ asset('adminassets/assets/bootstrap/dist/css/bootstrap.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('adminassets/assets/css/theme.min.css') }}" id="style-default">
        <link rel="stylesheet" href="{{ asset('adminassets/css/custom.css') }}" />
        <style>
            .alert {
                display: none;
                margin-top: 10px;
            }
            .form-control:focus {
                border-color: #80bdff;
                box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
            }

        </style>
    </head>
    <body>
        <main class="main" id="top">
            <div class="container">
                <div class="row flex-center g-0">
                    <div class="col-lg-8 col-xxl-5 position-relative">
                        <div class="card overflow-hidden z-index-1">
                            <div class="card-body p-0">
                                <div class="row g-0 h-100">
                                    <div class="col-md-5 text-center bg-card-gradient">
                                        {{-- <div class="position-relative p-4 pt-md-5 pb-md-7 light">
                                            <div class="bg-holder bg-auth-card-shape" style="background-image:url(adminassets/assets/img/icons/spot-illustrations/half-circle.png);"></div>
                                            <div class="z-index-1 position-relative">
                                                <a class="link-light mb-4 font-sans-serif fs-4 d-inline-block fw-bolder" href="#">{{ env('APP_NAME') }}</a>
                                                <img height="200" width="200" src="{{ asset('uploads/sitesetting/') }}">
                                            </div>
                                        </div> --}}
                                        <div class="col-md-5 text-center">
                                            <div class="position-relative pt-md-5 pb-md-7 light">
                                                <div class="bg-holder bg-auth-card-shape"></div>
                                                <div class="z-index-1 position-relative">
                                                    <img height="300" width="300" src="{{ asset('image/Sacred.png') }}" alt="Sacred Himalayan Honey">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-7 d-flex flex-center">
                                        <div class="p-4 p-md-5 flex-grow-1">
                                            <h3>{{ __('Admin Login') }}</h3>
                                            <x-auth-session-status class="mb-4" :status="session('status')" />
                                            <form id="loginForm" method="POST" action="{{ route('superadmin.login') }}">
                                                @csrf
                                                <div class="mb-3">
                                                    <x-input-label class="form-label" for="email" :value="__('Email')" />
                                                    <x-text-input id="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                                </div>
                                                <div class="mb-3">
                                                    <x-input-label class="form-label" for="password" :value="__('Password')" />
                                                    <x-text-input id="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" name="password" required autocomplete="current-password" />
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
                                                <div class="mb-3">
                                                    <button class="btn btn-primary d-block w-100" type="submit">{{ __('Log in') }}</button>
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
    </body>
    </html>
</x-guest-layout>
