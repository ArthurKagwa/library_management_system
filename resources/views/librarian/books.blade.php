<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Librarian Book Management
        </h2>
    </x-slot>

    @isset($books)
        <div class="p-6">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                {{__('Title')}}
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                {{__('Author')}}
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                {{__('Category')}}
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                {{__('ISBN')}}
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                {{__('Status')}}
                            </th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                {{__('Actions')}}
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($books as $book)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                    {{ $book->title }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                    {{ $book->author }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                    {{ $book->category }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                    <code class="bg-gray-100 dark:bg-gray-900 px-2 py-1 rounded">{{ $book->isbn }}</code>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                            <span @class([
                                'px-2 inline-flex text-xs leading-5 font-semibold rounded-full',
                                'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' => $book->status === 'available',
                                'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200' => $book->status === 'reserved',
                                'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' => $book->status === 'checked_out',
                                'bg-gray-100 text-gray-800 dark:bg-gray-600 dark:text-gray-300' => !in_array($book->status, ['available', 'reserved', 'checked_out'])
                            ])>
                                {{ ucfirst($book->status) }}
                            </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                                    <form method="GET" action="{{ route('librarian.books.reserve') }}" class="inline">

                                        <input type="text" name="book_id" value="{{ $book->id }}" hidden>
                                        <button type="submit" size="sm"
                                            @class([
                                                'bg-indigo-600 hover:bg-indigo-700' => $book->status === 'available',
                                                'bg-gray-400 cursor-not-allowed' => $book->status !== 'available'
                                            ])
                                            @disabled($book->status !== 'available')>
                                            {{__('Reserve')}}
                                        </button>
                                    </form>

                                    <form method="POST" action="{{ route('librarian.books.delete', $book) }}" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <x-danger-button type="submit" size="sm" onclick="return confirm('Are you sure you want to delete this book?')">
                                            {{__('Delete')}}
                                        </x-danger-button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    @endisset

</x-app-layout>
