<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Library Books Management') }}
        </h2>
        @if (session('success'))
            <div class="mb-4 text-sm text-green-600 dark:text-green-400">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="mb-4 text-sm text-red-600 dark:text-red-400">
                {{ session('error') }}
            </div>
        @endif
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Add New Book Form -->
                    <div class="mb-8">
                        <h3 class="text-lg font-medium mb-4">{{ __('Add New Book') }}</h3>
                        <form action="{{ route('librarian.books.store') }}" method="POST">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <x-input-label for="title" :value="__('Title')" />
                                    <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" required />
                                </div>
                                <div>
                                    <x-input-label for="author" :value="__('Author')" />
                                    <x-text-input id="author" name="author" type="text" class="mt-1 block w-full" required />
                                </div>
                                <div>
                                    <x-input-label for="isbn" :value="__('ISBN')" />
                                    <x-text-input id="isbn" name="isbn" type="text" class="mt-1 block w-full" required />
                                </div>
                                <div>
                                    <x-input-label for="quantity" :value="__('Number of Copies')" />
                                    <x-text-input id="quantity" name="quantity" type="number" min="1" class="mt-1 block w-full" required />
                                </div>
                                <div class="md:col-span-2">
                                    <x-input-label for="description" :value="__('Description')" />
                                   <textarea id="description" name="description" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" rows="3">{{ old('description') }}</textarea>
                                </div>
                                <div>
                                    <x-input-label for="published_date" :value="__('Published Date')" />
                                    <x-text-input id="published_date" name="published_date" type="date" class="mt-1 block w-full" />
                                </div>
                            </div>
                            <div class="mt-4">
                                <x-primary-button>{{ __('Add Book') }}</x-primary-button>
                            </div>
                        </form>
                    </div>

                    <!-- Books List -->
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
                                                <form action="{{ route('librarian.books.destroy', $book) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900" 
                                                            onclick="return confirm('Are you sure you want to delete this book and all its copies?')">
                                                        Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4">
                            {{ $books->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>