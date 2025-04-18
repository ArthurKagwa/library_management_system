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

            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-600 dark:text-gray-400">{{ __('Description') }}</label>
                <p class="mt-2 text-lg text-gray-900 dark:text-gray-300">{{ $book->description }}</p>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-600 dark:text-gray-400">{{ __('Availability') }}</label>
                <p class="mt-2 text-lg text-gray-900 dark:text-gray-300">{{ $available > 0 ? __('Available') : __('Not Available') }}</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <a href="{{ route('member.explore') }}" class="inline-flex items-center justify-center px-6 py-3 bg-blue-600 text-white font-semibold text-sm uppercase rounded-lg shadow-md hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2 transition ease-in-out duration-150">
                    {{ __('Back to Explore') }}
                </a>
                <a href="{{ route('member.books.reserve', $book->id) }}" class="inline-flex items-center justify-center px-6 py-3 bg-green-600 text-white font-semibold text-sm uppercase rounded-lg shadow-md hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-offset-2 transition ease-in-out duration-150">
                    {{ __('Borrow Book') }}
                </a>
            </div>
        </div>
    </div>

</x-app-layout>
