<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Librarian Book Management
        </h2>
    </x-slot>


    <div class="p-6 text-primary dark:text-primary-dark ">

        <h3 class="text-lg font-medium mb-4">{{ __('My Checkouts') }}</h3>
        @if($checkouts->isEmpty())
            <p>{{ __('No checkouts yet.') }}</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Title</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Author</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Copy Id</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Due date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200">
                    @foreach($checkouts as $checkout)
                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-700 cursor-pointer" onclick="window.location='{{ route('member.view-checkout', $checkout->id) }}'">
                            <td class="px-6 py-4 whitespace-nowrap">{{ $checkout->book->title }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $checkout->book->author }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $checkout->book_copy_id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $checkout->due_date->format('Y-m-d') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($checkout->due_date->isToday())
                                    <span class="text-yellow-500 font-semibold">Due Today</span>
                                @elseif($checkout->due_date->isFuture())
                                    <span class="text-green-500 font-semibold">On Time</span>
                                @else
                                    <span class="text-red-500 font-semibold">Overdue</span>
                                @endif
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
    </div>


</x-app-layout>
