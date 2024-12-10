<x-guest-layout>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>{{ env('APP_NAME') }} Register</title>
        <link rel="stylesheet" href="{{ asset('adminassets/assets/bootstrap/dist/css/bootstrap.min.css') }}" />
        {{-- <link rel="stylesheet" href="{{ asset('adminassets/assets/css/theme.min.css') }}" id="style-default">
        <link rel="stylesheet" href="{{ asset('adminassets/css/custom.css') }}" /> --}}
        <style>
            /* Custom CSS */
            body {
                font-family: Arial, sans-serif;
                background-color: #f8f9fa;
                margin: 0;
                padding: 0;
            }
            .main {
                display: flex;
                justify-content: center;
                align-items: center;
                min-height: 100vh;
            }
            .card {
                border-radius: 0.5rem;
                box-shadow: 0 4px 10px rgba(1, 1, 1, 0.2);
                max-width: 750px;
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
        </style>
    </head>
    <body>
        <main class="main" id="top">
            <div class="container">
                <div class="row flex-center g-0">
                    <div class="col-lg-10 col-xxl-8 position-relative"> <!-- Increase col width -->
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
                                            <h3>{{ __('Register') }}</h3>
                                            <form method="POST" action="{{ route('register') }}">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <x-input-label class="form-label" for="first_name" :value="__('First Name')" />
                                                        <x-text-input id="first_name" class="form-control mt-1" type="text" name="first_name" :value="old('first_name')" required autofocus />
                                                        <x-input-error :messages="$errors->get('first_name')" class="mt-2 text-danger" />
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <x-input-label class="form-label" for="last_name" :value="__('Last Name')" />
                                                        <x-text-input id="last_name" class="form-control mt-1" type="text" name="last_name" :value="old('last_name')" required />
                                                        <x-input-error :messages="$errors->get('last_name')" class="mt-2 text-danger" />
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <x-input-label class="form-label" for="email" :value="__('Email')" />
                                                    <x-text-input id="email" class="form-control mt-1" type="email" name="email" :value="old('email')" required />
                                                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
                                                </div>
                                                <div class="mb-3">
                                                    <x-input-label class="form-label" for="password" :value="__('Password')" />
                                                    <x-text-input id="password" class="form-control mt-1" type="password" name="password" required />
                                                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger" />
                                                </div>
                                                <div class="mb-3">
                                                    <x-input-label class="form-label" for="password_confirmation" :value="__('Confirm Password')" />
                                                    <x-text-input id="password_confirmation" class="form-control mt-1" type="password" name="password_confirmation" required />
                                                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-danger" />
                                                </div>
                                                <div class="d-flex justify-content-between">
                                                    <a class="btn btn-link text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                                                        {{ __('Already registered?') }}
                                                    </a>
                                                    <button class="btn btn-primary" style="background-color: #bb7030; border-color:#bb7030">
                                                        {{ __('Register') }}
                                                    </button>
                                                </div>
                                            </form>
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
