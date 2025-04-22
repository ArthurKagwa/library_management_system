<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Library App</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
  /* Keyframes for image transitions */

@keyframes fade {
    0% { opacity: 0; }
    16.67% { opacity: 1; } /* 100% / 6 images = ~16.67% */
    33.33% { opacity: 1; }
    50% { opacity: 0; }
    100% { opacity: 0; }
}

/* Image transition styles */
.background-images img {
    position: absolute;
    width: 100%;
    height: 100%;
    object-fit: cover;
    animation: fade 36s infinite; /* Adjusted to 36s for six images */
    image-rendering: auto; /* Ensures smooth rendering */
    image-rendering: crisp-edges; /* For sharp edges */
    opacity: 0; /* Start with all images hidden */
    z-index: -1; /* Ensure images stay in the background */
}

.background-images img:nth-child(1) {
    animation-delay: 0s;
}

.background-images img:nth-child(2) {
    animation-delay: 6s; /* 36s / 6 = 6s per image */
}

.background-images img:nth-child(3) {
    animation-delay: 12s;
}

.background-images img:nth-child(4) {
    animation-delay: 18s;
}

.background-images img:nth-child(5) {
    animation-delay: 24s;
}

.background-images img:nth-child(6) {
    animation-delay: 30s;
}
</style>
</head>
<body class="text-primary dark:text-primary-dark bg-secondary dark:bg-secondary-dark relative">
    <!-- Background Image Transitions -->
    <div class="background-images">
        <img src="/images/bil1.jpg" alt="Library Background 1"loading="lazy">
        <img src="/images/bil2.jpg" alt="Library Background 2"loading="lazy">
        <img src="/images\nani-chavez-aPs_QDIuPUM-unsplash.jpg" alt="Library Background 3"loading="lazy">
         <img src="/images/jaredd-craig-HH4WBGNyltc-unsplash.jpg" alt="LibrarBackground 3"loading="lazy">
          <img src="/images/gabriel-sollmann-Y7d265_7i08-unsplash.jpg" alt="LibBackground 3"loading="lazy">
           <img src="/images/bil6.jpg" alt="Library Bacund 3"loading="lazy">
    </div>

    <nav>
        <div class="flex justify-between items-center p-4 bg-gradient-to-r from-blue-600 via-green-500 to-gray-500 dark:from-gray-800 dark:via-gray-700 dark:to-gray-600 shadow-lg">
            <div class="text-2xl font-extrabold text-white">Library App</div>

            <div class="text-xl font-bold text-white">
                @auth
                    @if(auth()->user()->hasVerifiedEmail())
                        <div class="flex items-center space-x-4">
                            <a href="{{ route('dashboard') }}"
                               class="px-4 py-2 bg-white text-blue-600 font-bold rounded hover:bg-blue-100 hover:scale-105 transition duration-300 ease-in-out">
                                Dashboard
                            </a>

                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit"
                                        class="px-4 py-2 bg-white text-red-600 font-bold rounded hover:bg-red-100 hover:scale-105 transition duration-300 ease-in-out">
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
                        <a href="{{ route('register') }}" class="hover:text-blue-300 transition duration-300 ease-in-out">Register</a>
                        <a href="{{ route('login') }}" class="hover:text-blue-300 transition duration-300 ease-in-out">Login</a>
                    </div>
                @endauth
            </div>
        </div>
    </nav>

    <main>
        <div class="flex flex-col justify-center items-center h-screen text-center">
            <h1 class="text-white mb-20" style="font-size: 5rem; font-weight: 900; text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.7);">
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
                                    class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 hover:scale-105 transition duration-300 ease-in-out">
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