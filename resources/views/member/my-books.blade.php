<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Books') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium mb-4">{{ __('Currently Checked Out Books') }}</h3>
                    
                    @if($checkedOutBooks->isEmpty())
                        <p>{{ __('You have no books checked out at the moment.') }}</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Title</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Author</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Due Date</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Copy Number</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200">
                                    @foreach($checkedOutBooks as $transaction)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $transaction->bookCopy->book->title }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $transaction->bookCopy->book->author }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $transaction->due_date->format('Y-m-d') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $transaction->bookCopy->copy_number }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                    <h3 class="text-lg font-medium mt-8 mb-4">{{ __('My Reservations') }}</h3>
                    
                    @if($reservations->isEmpty())
                        <p>{{ __('You have no active reservations.') }}</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Title</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Author</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Reservation Date</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200">
                                    @foreach($reservations as $reservation)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $reservation->book->title }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $reservation->book->author }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                    {{ $reservation->status === 'ready_for_pickup' ? 'bg-green-100 text-green-800' : 
                                                       ($reservation->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                                                       ($reservation->status === 'cancelled' ? 'bg-gray-100 text-gray-800' : 'bg-blue-100 text-blue-800')) }}">
                                                    {{ ucfirst(str_replace('_', ' ', $reservation->status)) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $reservation->reservation_date->format('Y-m-d') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>