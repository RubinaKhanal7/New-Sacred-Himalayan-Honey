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
            <div class="mb-4 text-sm text-gray-600">
                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Address -->
                <div class="form-group">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" style="margin:10px" required autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="form-group d-flex justify-content-end mt-4">
                    <button type="submit" class="btn-custom">
                        {{ __('Email Password Reset Link') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
