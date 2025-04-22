<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Book Details') }}
        </h2>
    </x-slot>

    <div class="p-12 ">
        <div class="p-6 mx-6 bg-white dark:bg-gray-800 shadow-lg rounded-lg border border-gray-200 dark:border-gray-700">
            <h3 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-6">{{ __('Book Information') }}</h3>

            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-600 dark:text-gray-400">{{ __('Title') }}</label>
                <p class="mt-2 text-lg text-gray-900 dark:text-gray-300">{{ $book->title }}</p>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-600 dark:text-gray-400">{{ __('Author') }}</label>
                <p class="mt-2 text-lg text-gray-900 dark:text-gray-300">{{ $book->author }}</p>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-600 dark:text-gray-400">{{ __('ISBN') }}</label>
                <p class="mt-2 text-lg text-gray-900 dark:text-gray-300">{{ $book->isbn }}</p>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-600 dark:text-gray-400">{{ __('Published Year') }}</label>
                <p class="mt-2 text-lg text-gray-900 dark:text-gray-300">{{ $book->published_year }}</p>
            </div>

            <div class="mb-8 p-6 rounded-lg bg-white dark:bg-gray-800 shadow-lg border border-gray-200 dark:border-gray-700">
                <!-- Original Description -->
                <label class="block text-sm font-semibold text-gray-600 dark:text-gray-400 mb-2">{{ __('Description') }}</label>
                <p class="mb-6 text-lg text-gray-700 dark:text-gray-300 leading-relaxed">{{ $book->description }}</p>

                <!-- AI Generated Description - Highlighted Section -->
                <div class="relative mt-8">
                    <div class="absolute -top-5 right-0">
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
                AI Enhanced
            </span>
                    </div>

                    <div class="p-5 rounded-lg bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/30 dark:to-indigo-900/30 border border-blue-100 dark:border-blue-800">
                        <h3 class="text-lg font-semibold text-blue-800 dark:text-blue-300 mb-3 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M17.293 5.293a1 1 0 00-1.414 0L9 12.586 5.707 9.293a1 1 0 00-1.414 1.414l4 4a1 1 0 001.414 0l8-8a1 1 0 000-1.414z" clip-rule="evenodd" />
                            </svg>
                            {{ __('AI Generated Description') }}
                        </h3>

                        <div class="relative">
                            @livewire('book-description', ['bookTitle' => $book->title, 'bookAuthor' => $book->author])
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-600 dark:text-gray-400">{{ __('Availability') }}</label>
                <p class="mt-2 text-lg text-gray-900 dark:text-gray-300">{{ $available > 0 ? __('Available') : __('Not Available') }}</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <a href="{{ route('member.explore') }}" class="inline-flex items-center justify-center px-6 py-3 bg-blue-600 text-white font-semibold text-sm uppercase rounded-lg shadow-md hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2 transition ease-in-out duration-150">
                    {{ __('Back to Explore') }}
                </a>
                <a href="{{ route('member.reserve', $book->id) }}" class="inline-flex items-center justify-center px-6 py-3 bg-green-600 text-white font-semibold text-sm uppercase rounded-lg shadow-md hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-offset-2 transition ease-in-out duration-150">
                    {{ __('Borrow Book') }}
                </a>
            </div>
        </div>
    </div>

</x-app-layout>
