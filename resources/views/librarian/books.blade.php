<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Librarian Book Management
        </h2>
    </x-slot>

    @isset($books)
    <div class="p-7">
        <div class="dark:border-gray-200 border-spacing-2 ">
            <table>
                <tr>
                    <th>
                        {{__('Title')}}
                    </th>
                    <th>
                        {{__('Author')}}
                    </th>
                    <th>
                        {{__('Category')}}
                    </th>
                    <th>
                        {{__('ISBN')}}
                    </th>
                    <th>
                        {{__('Status')}}
                    </th>
                    <th>
                        {{__('Actions')}}
                    </th>

                </tr>
                @foreach($books as $book)
                    <tr>
                        <td>
                            {{ $book->title }}
                        </td>
                        <td>
                            {{ $book->author }}
                        </td>
                        <td>
                            {{ $book->category }}
                        </td>
                        <td>
                            {{ $book->isbn }}
                        </td>
                        <td>
                            {{ $book->status }}
                        </td>
                        <td>
                            <form method="POST" action="{{ route('librarian.books.delete', $book) }}">
                                @csrf
                                @method('DELETE')
                                <x-primary-button type="submit" onclick="return confirm('Are you sure you want to delete this book?')">
                                    {{__('DELETE')}}
                                </x-primary-button>
                            </form>
{{--                            reserve--}}
                            <form method="POST" action="{{ route('librarian.books.reserve', $book) }}">
                                @csrf
                                <x-primary-button type="submit">
                                    {{__('RESERVE')}}
                                </x-primary-button>
                            </form>

                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
    @endisset

</x-app-layout>
