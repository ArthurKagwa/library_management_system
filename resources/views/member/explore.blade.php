<!-- filepath: c:\Users\DELL\Desktop\library_management_system\resources\views\member\explore.blade.php -->
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
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
                @forelse($books as $book)
                    <div class="flex flex-col items-center bg-white dark:bg-gray-800 border rounded-lg shadow-md hover:shadow-lg transition-shadow">
                        @if($book->image)
                            <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->title }}" class="w-full h-48 object-cover rounded-t-lg">
                        @else
                            <div class="w-full h-48 bg-gray-200 rounded-t-lg flex items-center justify-center">
                                <span class="text-gray-500">No Image</span>
                            </div>
                        @endif
                        <div class="p-4 text-center">
                            <h3 class="text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2">
                                {{ $book->title }}
                            </h3>
                            <p class="text-xs text-gray-600 dark:text-gray-400">{{ $book->author }}</p>
                            <a href="{{ route('view.book', $book->id) }}" class="mt-2 inline-block px-3 py-1 text-xs font-medium text-white bg-indigo-600 rounded hover:bg-indigo-700">
                                View Details
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full p-4 text-center text-gray-600 dark:text-gray-400">
                        No books found matching the selected criteria.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>