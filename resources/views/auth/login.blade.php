<x-guest-layout>
    <style>
        /* Background image styling */
        body {
            background: url('/images/4907559.jpg') no-repeat center center fixed;
            background-size: cover; /* Ensures the image covers the entire viewport */
            height: 100vh; /* Sets the height to fill the viewport */
            margin: 0; /* Removes default margin */
            display: flex; /* Centers the form vertically and horizontally */
            justify-content: center;
            align-items: center;
        }

        /* Form container styling */
        .form-container {
            background: rgba(255, 255, 255, 0.6); /* Semi-transparent white background */
            backdrop-filter: blur(10px); /* Adds a blur effect to the background */
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            max-width: 400px;
            width: 100%; /* Ensures responsiveness */
        }

        /* Input field styling */
        .form-container input {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 0.75rem;
            width: 100%;
            margin-top: 0.5rem;
        }

        /* Button styling */
        .form-container button {
            background: linear-gradient(to right, #4f46e5, #3b82f6);
            color: white;
            border: none;
            border-radius: 5px;
            padding: 0.75rem 1.5rem;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.3s ease;
        }

        .form-container button:hover {
            background: linear-gradient(to right, #3b82f6, #2563eb);
            transform: scale(1.05); /* Slightly enlarges the button on hover */
        }

        /* Link styling */
        .form-container a {
            color: #4f46e5;
            text-decoration: underline;
            transition: color 0.3s ease;
        }

        .form-container a:hover {
            color: #2563eb;
        }
    </style>

    <div class="form-container">
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-between mt-4">
                @if (Route::has('password.request'))
                    <a class="text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <button type="submit">
                    {{ __('Log in') }}
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>