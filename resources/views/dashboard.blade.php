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
                    {{ __("You're logged in!") }}
                </p>
            </div>

            {{-- Two Side-by-Side Cards --}}
            <div class="flex flex-col md:flex-row gap-4">
                {{-- Image Carousel Card --}}
                <div class="w-full md:w-1/2 bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden" style="height: 400px;">
                    <div id="carousel" class="relative w-full h-full">
                        <img src="/images/readingAbook.jpeg" class="carousel-image w-full h-full object-cover absolute inset-0 opacity-0 transition-opacity duration-1000" alt="Book 1">
                        <img src="/images/library.jpeg" class="carousel-image w-full h-full object-cover absolute inset-0 opacity-0 transition-opacity duration-1000" alt="Book 2">
                        <img src="/images/read.jpeg" class="carousel-image w-full h-full object-cover absolute inset-0 opacity-0 transition-opacity duration-1000" alt="Book 3">
                    </div>
                </div>

                {{-- Quote Card --}}
                <div class="w-full md:w-1/2 bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 flex flex-col justify-center" style="height: 400px;">
                    <h3 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 mb-4">Quote of the Day</h3>
                    <p class="text-lg text-gray-700 dark:text-gray-300 italic">
                        "A reader lives a thousand lives before he dies . . . The man who never reads lives only one."
                        <br><span class="block mt-2 text-right">— George R.R. Martin</span>
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- JS-Based Carousel --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const images = document.querySelectorAll('.carousel-image');
            let current = 0;
            const intervalTime = 15000; // 15 seconds per image

            function showImage(index) {
                images.forEach((img, i) => {
                    img.style.opacity = i === index ? '1' : '0';
                });
            }

            function nextImage() {
                current = (current + 1) % images.length;
                showImage(current);
            }

            showImage(current); // show the first image
            setInterval(nextImage, intervalTime);
        });
    </script>

    {{-- Optional: Remove scroll --}}
    <style>
        html, body {
            overflow-y: hidden;
        }
    </style>
</x-app-layout>
