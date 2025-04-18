<x-app-layout>
    <x-slot name="header">
    <div class="bg-pink-500 dark:bg-pink-600 px-4 py-3 rounded-md">

        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Member Dashboard') }}
        </h2>
    </div>
    </x-slot>

    <div class="flex-grow min-h-screen py-12 bg-gray-100 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-6 flex flex-col gap-2 h-[3vh]">
            {{-- Welcome Card --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-2 text-secondary-dark dark:text-secondary">
                    {{ __("You're logged in!") }}
                </div>
            </div>

            {{-- Two Side-by-Side Cards --}}
            <div class="flex flex-col md:flex-row gap-3 flex-grow">
                {{-- Image Carousel Card --}}
                <div class="w-full md:w-1/2 bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden h-auto" style="min-height: 400px; height: 100%;">
                    <div class="relative w-full h-full">
                        <div class="absolute inset-0 w-full h-full animate-slide">
                            <img src="/images/readingAbook.jpeg" alt="Book 1" class="w-full h-full object-cover">
                        </div>
                        <div class="absolute inset-0 w-full h-full animate-slide delay-3000">
                            <img src="/images/library.jpeg" alt="Book 2" class="w-full h-full object-cover">
                        </div>
                        <div class="absolute inset-0 w-full h-full animate-slide delay-3000">
                            <img src="/images/read.jpeg" alt="Book 2" class="w-full h-full object-cover">
                        </div>
                        
                    </div>
                </div>

                {{-- Quote Card --}}
                <div class="w-full md:w-1/2 bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 flex flex-col justify-center h-auto" style="min-height: 400px; height: 100%;">
                    <h3 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 mb-4">Quote of the Day</h3>
                    <p class="text-lg text-gray-700 dark:text-gray-300 italic">
                        "A reader lives a thousand lives before he dies . . . The man who never reads lives only one."
                        <br><span class="block mt-2 text-right">— George R.R. Martin</span>
                    </p>
                </div>
            </div>
        </div>
</div>

    {{-- Tailwind Custom Animation --}}
    <style>
        @keyframes slideFade {
            0%, 100% { opacity: 0; }
            10%, 90% { opacity: 1; }
        }
        .animate-slide {
            animation: slideFade 9s infinite;
            opacity: 0;
        }
        .animate-slide:first-child {
            opacity: 3;
        }
        .delay-3000 {
            animation-delay: 6s;
        }
        .delay-6000 {
            animation-delay: 6s;
        }
    </style>
    {{-- Footer --}}

</x-app-layout>