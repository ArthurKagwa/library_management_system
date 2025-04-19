<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Library App</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="text-primary dark:text-primary-dark bg-secondary dark:bg-secondary-dark" 
      style="background-image: url('/images/4907559.jpg'); 
             background-size: cover;
             background-position: center;
             background-repeat: no-repeat;
             background-attachment: fixed;">
<nav>
    <div class="flex justify-between items-center p-4 bg-secondary dark:bg-secondary-dark">
    <div class="text-xl font-bold text-primary dark:text-primary-dark">Library App</div>

<div class="text-xl font-bold text-primary dark:text-primary-dark">
    @auth
        @if(auth()->user()->hasVerifiedEmail())
            <div class="flex items-center space-x-4">
                <a href="{{ route('dashboard') }}"
                   class="px-4 py-2 bg-white text-pink-600 font-bold rounded hover:bg-pink-100 transition">
                    Dashboard
                </a>

                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit"
                            class="px-4 py-2 bg-white text-pink-600 font-bold rounded hover:bg-pink-100 transition">
                        Logout
                    </button>
                </form>
            </div>
        @else
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="hover:text-primary-dark">Resend Verification</button>
            </form>
        @endif
    @else
        <div class="flex space-x-4">
            <a href="{{ route('register') }}" class="hover:text-primary-dark">Register</a>
            <a href="{{ route('login') }}" class="hover:text-primary-dark">Login</a>
        </div>
    @endauth
</div>

    </div>
</nav>
<hr class="bg-primary-dark">
<main>
    <div class="flex flex-col justify-center items-center h-screen text-center">
    <h1 class="text-white mb-20" style="font-size: 5rem; font-weight: 900;">
        Welcome to the Library App
    </h1>

        @auth
            @unless(auth()->user()->hasVerifiedEmail())
                <div class="max-w-md p-6 bg-gray-200 dark:bg-gray-800 rounded-lg shadow-lg">
                    <h2 class="text-xl font-semibold mb-4">Verify Your Email</h2>
                    <p class="mb-4">Please check your email for a verification link.</p>

                    @if (session('status') === 'verification-link-sent')
                        <div class="mb-4 text-green-600 dark:text-green-400">
                            A new verification link has been sent!
                        </div>
                    @endif

                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit"
                                class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                            Resend Verification Email
                        </button>
                    </form>
                </div>
            @endunless
        @endauth
    </div>
</main>
</body>
</html>
