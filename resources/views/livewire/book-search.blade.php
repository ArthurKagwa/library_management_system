<div class="relative">
    <!-- Search Input -->
    <div class="relative">
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <svg class="h-5 w-5 text-gray-400 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </div>
        <input
            type="text"
            wire:model.live="search"
            class="w-full pl-10 pr-8 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-blue-500 focus:border-blue-500 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-400"
            placeholder="Search for a book by title or author..."
            autocomplete="off"
        />
    </div>

    <!-- Search Results -->
    @if(strlen($search) > 0)
        <div class="mt-2 relative">
            @if(count($results) > 0)
                <ul class="absolute z-10 w-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-lg divide-y divide-gray-200 dark:divide-gray-700 max-h-96 overflow-y-auto">
                    @foreach($results as $book)
                        <li
                            wire:click="selectBook({{ $book->id }})"
                            class="px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer flex items-start"
                        >
                            @if($book->image)
                                <img src="{{ asset('storage/' . $book->image) }}" alt="Book cover" class="w-10 h-14 object-cover rounded mr-3">
                            @else
                                <div class="w-10 h-14 bg-gray-100 dark:bg-gray-700 rounded mr-3 flex items-center justify-center">
                                    <svg class="h-6 w-6 text-gray-400 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                </div>
                            @endif
                            <div>
                                <div class="font-medium text-gray-900 dark:text-gray-100">{{ $book->title }}</div>
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
        <div class="mt-4 p-3 bg-green-50 dark:bg-green-900/20 border border-green-100 dark:border-green-800 rounded-lg flex items-start">
            <div class="flex-shrink-0 mr-3">
                @if($selectedBook->image)
                    <img src="{{ asset('storage/' . $selectedBook->image) }}" alt="Selected book cover" class="w-12 h-16 object-cover rounded">
                @else
                    <div class="w-12 h-16 bg-green-100 dark:bg-green-800 rounded flex items-center justify-center">
                        <svg class="h-6 w-6 text-green-500 dark:text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                @endif
            </div>
            <div>
                <div class="font-medium text-green-800 dark:text-green-200">Selected Book</div>
                <div class="text-gray-900 dark:text-gray-100">{{ $selectedBook->title }}</div>
                <div class="text-sm text-gray-600 dark:text-gray-300">{{ $selectedBook->author }}</div>
            </div>
        </div>
    @endif
</div>
