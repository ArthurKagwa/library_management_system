<x-app-layout>
    <x-slot name="header">
        <div class="bg-pink-500 dark:bg-pink-600 px-4 py-3 rounded-md">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Member Dashboard') }}
            </h2>
        </div>
    </x-slot>

    <div class="min-h-screen bg-gray-100 dark:bg-gray-900 flex flex-col justify-start items-center pt-8 px-4">
        <div class="w-full max-w-7xl space-y-4">
            {{-- Welcome Card --}}
            <div class="bg-white dark:bg-gray-800 shadow-md sm:rounded-lg p-4">
                <p class="text-gray-700 dark:text-gray-300">
                    {{ __("Welcome back! Explore new features and manage your library activities.") }}
                </p>
            </div>

            {{-- Two Side-by-Side Cards --}}
            <div class="flex flex-col md:flex-row gap-4">
                {{-- Image Carousel Card --}}
                <div class="w-full md:w-1/2 bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden relative" style="height: 400px;">
                    <div id="carousel" class="relative w-full h-full">
                        <img src="/images/lib1.jpg" class="carousel-image w-full h-full object-cover absolute inset-0 opacity-0 transition-opacity duration-1000" alt="Library Image 1">
                        <img src="/images/lib2.jpg" class="carousel-image w-full h-full object-cover absolute inset-0 opacity-0 transition-opacity duration-1000" alt="Library Image 2">
                        <img src="/images/lib3.jpg" class="carousel-image w-full h-full object-cover absolute inset-0 opacity-0 transition-opacity duration-1000" alt="Library Image 3">
                    </div>
                    {{-- Carousel Controls --}}
                    <button id="prev" class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-gray-800 text-white p-2 rounded-full hover:bg-gray-700">
                        &larr;
                    </button>
                    <button id="next" class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-gray-800 text-white p-2 rounded-full hover:bg-gray-700">
                        &rarr;
                    </button>
                </div>

                {{-- Quick Actions Card --}}
                <div class="w-full md:w-1/2 bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 flex flex-col justify-center" style="height: 400px;">
                    <h3 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 mb-4">Quick Actions</h3>
                    <div class="space-y-4">
                        <a href="{{ route('member.books.reserve') }}" class="block bg-indigo-600 text-white text-center py-2 rounded-md hover:bg-indigo-700">
                            View All Books
                        </a>
                        <a href="{{ route('profile.edit') }}" class="block bg-green-600 text-white text-center py-2 rounded-md hover:bg-green-700">
                            Edit Profile
                        </a>
                        <a href="{{ route('member.books.reserve') }}" class="block bg-yellow-600 text-white text-center py-2 rounded-md hover:bg-yellow-700">
                            Manage Reservations
                        </a>
                    </div>
                </div>
            </div>

            {{-- Statistics Overview --}}
            <div class="bg-white dark:bg-gray-800 shadow-md sm:rounded-lg p-6">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-4">Statistics Overview</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="bg-indigo-600 text-white p-4 rounded-lg shadow-md">
                        <h4 class="text-lg font-semibold">Books</h4>
                        <p class="text-2xl font-bold">{{ $totalBooks ?? 0 }}</p>
                    </div>
                    <div class="bg-green-600 text-white p-4 rounded-lg shadow-md">
                        <h4 class="text-lg font-semibold">Members</h4>
                        <p class="text-2xl font-bold">{{ $totalMembers ?? 0 }}</p>
                    </div>
                    <div class="bg-yellow-600 text-white p-4 rounded-lg shadow-md">
                        <h4 class="text-lg font-semibold">Reservations</h4>
                        <p class="text-2xl font-bold">{{ $totalReservations ?? 0 }}</p>
                    </div>
                    <div class="bg-red-600 text-white p-4 rounded-lg shadow-md">
                        <h4 class="text-lg font-semibold">Overdue Books</h4>
                        <p class="text-2xl font-bold">{{ $overdueBooks ?? 0 }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- JS-Based Carousel --}}
   <script>
    document.addEventListener('DOMContentLoaded', () => {
        const images = document.querySelectorAll('.carousel-image');
        let current = 0;
        const intervalTime = 5000; // 5 seconds per image

        // Show the current image in the carousel
        function showImage(index) {
            images.forEach((img, i) => {
                img.style.opacity = i === index ? '1' : '0';
                img.style.transition = 'opacity 1s ease-in-out'; // Smooth transition effect
            });
        }

        // Go to the next image
        function nextImage() {
            current = (current + 1) % images.length;
            showImage(current);
        }

        // Initialize the carousel
        showImage(current); // Show the first image
        setInterval(nextImage, intervalTime); // Automatically change images every 5 seconds
    });
</script>
</x-app-layout>