<style>
    /* Custom CSS for centering the form */
.center-form-container {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}

.form-box {
    width: 100%;
    max-width: 500px;
    padding: 20px;
    background-color: #ffffff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
}

/* Custom styles for buttons */
.btn-custom {
    background-color: #007bff;
    border: none;
    color: white;
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
    border-radius: 5px;
}

.btn-custom:hover {
    background-color: #0056b3;
}

</style>
<x-guest-layout>
    <div class="center-form-container">
        <div class="form-box">
            <form method="POST" action="{{ route('password.store') }}">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email Address -->
                <div class="form-group">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="form-group mt-4">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="form-control" type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="form-group mt-4">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                    <x-text-input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="form-group d-flex justify-content-end mt-4">
                    <button type="submit" class="btn-custom">
                        {{ __('Reset Password') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
