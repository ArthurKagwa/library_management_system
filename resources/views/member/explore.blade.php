<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Explore') }}
        </h2>
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 p-4">
        @foreach($books as $book)
            <a href="{{route('view.book', $book->id)}}">
                <div class="p-4 border rounded shadow-sm bg-white dark:bg-gray-800">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">
                        {{ $book->title }}
                    </h3>
                </div>
            </a>

        @endforeach
    </div>
</x-app-layout>
