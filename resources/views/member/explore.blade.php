<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Explore') }}
        </h2>
    </x-slot>
    
    <div class="py-4">
        <div class="max-w-7xl mx-auto px-4">
            <!-- Filters Section -->
            <div class="mb-6 p-4 bg-white dark:bg-gray-800 rounded shadow-sm">
                <form action="{{ route('member.explore') }}" method="GET" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Search by Title -->
                        <div>
                            <label for="search" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Search by Title</label>
                            <input type="text" name="search" id="search" value="{{ request('search') }}" 
                                class="w-full rounded-md border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" 
                                placeholder="Enter book title...">
                        </div>
                        
                        <!-- Rating Filter -->
                        <div>
                            <label for="rating" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Minimum Rating</label>
                            <select name="rating" id="rating" class="w-full rounded-md border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="">Any Rating</option>
                                <option value="5" {{ request('rating') == 5 ? 'selected' : '' }}>5 Stars</option>
                                <option value="4" {{ request('rating') == 4 ? 'selected' : '' }}>4+ Stars</option>
                                <option value="3" {{ request('rating') == 3 ? 'selected' : '' }}>3+ Stars</option>
                                <option value="2" {{ request('rating') == 2 ? 'selected' : '' }}>2+ Stars</option>
                                <option value="1" {{ request('rating') == 1 ? 'selected' : '' }}>1+ Stars</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="flex justify-end">
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-md shadow-sm">
                            Apply Filters
                        </button>
                        <a href="{{ route('member.explore') }}" class="ml-2 bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 font-medium py-2 px-4 rounded-md shadow-sm">
                            Reset
                        </a>
                    </div>
                </form>
            </div>
            
            <!-- Books Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @forelse($books as $book)
                    <a href="{{route('view.book', $book->id)}}">
                        <div class="p-4 border rounded shadow-sm bg-white dark:bg-gray-800 hover:shadow-md transition-shadow">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-2">
                                {{ $book->title }}
                            </h3>
                            
                            <!-- Star Rating -->
                            @if(isset($book->average_rating))
                            <div class="flex items-center mt-2">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $book->average_rating)
                                        <svg class="w-4 h-4 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                            <path d="M10 15.27L16.18 19l-1.64-7.03L20 7.24l-7.19-.61L10 0 7.19 6.63 0 7.24l5.46 4.73L3.82 19z"/>
                                        </svg>
                                    @else
                                        <svg class="w-4 h-4 text-gray-300 fill-current" viewBox="0 0 20 20">
                                            <path d="M10 15.27L16.18 19l-1.64-7.03L20 7.24l-7.19-.61L10 0 7.19 6.63 0 7.24l5.46 4.73L3.82 19z"/>
                                        </svg>
                                    @endif
                                @endfor
                                <span class="ml-1 text-sm text-gray-600 dark:text-gray-400">
                                    ({{ number_format($book->average_rating, 1) }})
                                </span>
                            </div>
                            @endif
                        </div>
                    </a>
                @empty
                    <div class="col-span-full p-4 text-center text-gray-600 dark:text-gray-400">
                        No books found matching the selected criteria.
                    </div>
                @endforelse
            </div>
            
            <!-- Pagination Links -->
            <div class="mt-6">
                {{ $books->withQueryString()->links() }}
            </div>
        </div>
    </div>
</x-app-layout>