<div class="relative">
    <!-- Search Input -->
    <div class="relative">
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 dark:text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
            </svg>
        </div>
        <input
            type="text"
            wire:model.live="search"
            class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-500 dark:focus:border-blue-500 text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-700 placeholder-gray-400 dark:placeholder-gray-400 transition duration-150 ease-in-out"
            placeholder="Search for a book by title or author..."
            autocomplete="off"
        />
        @if($search)
            <button wire:click="$set('search', '')" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                </svg>
            </button>
        @endif
    </div>

    <!-- Search Results -->
    @if(strlen($search) > 0)
        <div class="mt-2 relative">
            @if(count($results) > 0)
                <ul class="absolute z-10 w-full bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg shadow-lg overflow-hidden divide-y divide-gray-200 dark:divide-gray-600 max-h-96 overflow-y-auto">
                    @foreach($results as $book)
                        <li
                            wire:click="selectBook({{ $book->id }})"
                            class="px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors duration-150 cursor-pointer flex items-start"
                        >
                            @if($book->image)
                                <img src="{{ asset('storage/' . $book->image) }}" alt="Book cover" class="w-10 h-14 object-cover rounded mr-3 flex-shrink-0">
                            @else
                                <div class="w-10 h-14 bg-gray-100 dark:bg-gray-600 rounded mr-3 flex items-center justify-center flex-shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                </div>
                            @endif
                            <div class="min-w-0">
                                <div class="font-medium text-gray-900 dark:text-gray-100 truncate">{{ $book->title }}</div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">{{ $book->author }}</div>
                                @if($book->published_year)
                                    <div class="text-xs text-gray-400 dark:text-gray-500 mt-1">{{ $book->published_year }}</div>
                                @endif
                            </div>
                        </li>
                    @endforeach
                </ul>

            @endif
        </div>
    @endif

    <!-- Selected Book -->
    @if($selectedBook)
        <div class="mt-4 p-3 bg-green-50 dark:bg-green-900/30 border border-green-100 dark:border-green-800 rounded-lg flex items-start">
            <div class="flex-shrink-0 mr-3">
                @if($selectedBook->image)
                    <img src="{{ asset('storage/' . $selectedBook->image) }}" alt="Selected book cover" class="w-12 h-16 object-cover rounded">
                @else
                    <div class="w-12 h-16 bg-green-100 dark:bg-green-800 rounded flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500 dark:text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                @endif
            </div>
            <div class="min-w-0">
                <div class="font-medium text-green-800 dark:text-green-200">{{ __('Selected Book') }}</div>
                <div class="text-gray-900 dark:text-gray-100">{{ $selectedBook->title }}</div>
                <div class="text-sm text-gray-600 dark:text-gray-300">{{ $selectedBook->author }}</div>
            </div>
            <button
                wire:click="clearSelection"
                class="ml-auto text-gray-400 hover:text-gray-600 dark:hover:text-gray-200"
                aria-label="Clear selection"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
        </div>
    @endif
</div>
