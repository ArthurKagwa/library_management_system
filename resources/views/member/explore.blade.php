<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Explore') }}
        </h2>
    </x-slot>
    <div class="p-4">
        @livewire('explore-search')
    </div>

    <div class="py-4">
        <div class="max-w-7xl mx-auto px-4">

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
    </div>
    </div>
</x-app-layout>
