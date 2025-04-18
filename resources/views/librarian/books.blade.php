<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Librarian Book Management
        </h2>
    </x-slot>

    <livewire:book-search />

    <div class="p-6 text-primary dark:text-primary-dark ">
        <h3 class="text-lg font-medium mb-4">{{ __('Library Books') }}</h3>
        @if($books->isEmpty())
            <p>{{ __('No books in the library yet.') }}</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Title</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Author</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">ISBN</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Copies</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Available</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200">
                    @foreach($books as $book)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $book->title }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $book->author }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $book->isbn }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $book->copies->count() }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $book->copies->where('status', 'available')->count() }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <a href="{{ route('librarian.books.reserve', $book->id) }}"
                                   class="text-blue-600 hover:text-blue-900 mr-2">Reserve</a>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{--        </div>--}}
                {{--        <div class="mt-4">--}}
                {{--            {{ $books->links() }}--}}
                {{--        </div>--}}
                @endif
    </div>


</x-app-layout>
