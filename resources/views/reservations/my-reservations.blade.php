<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Member Book Reservations') }}
        </h2>

    </x-slot>
    <div class="p-6">

        <livewire:stats :stats="$stats" />

    </div>
    <div class="p-6">
        {{--        show reservations in table with actions--}}
        <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            {{__('Book Title')}}
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            {{__('Member Name')}}
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            {{__('Reservation Date')}}
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            {{__('Status')}}
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            {{__('Actions')}}
                        </th>

                    </tr>
                    </thead>
                  <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
    @foreach($reservations as $reservation)
        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                {{ $reservation->book->title }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                {{ $reservation->user->name }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                {{ $reservation->reservation_date->format('Y-m-d H:i:s') }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                <span @class([
                    'px-2 inline-flex text-xs leading-5 font-semibold rounded-full',
                    'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' => $reservation->status === 'reserved',
                    'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200' => $reservation->status === 'pending',
                    'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' => $reservation->status === 'expired',
                    'bg-gray-100 text-gray-800 dark:bg-gray-600 dark:text-gray-300' => !in_array($reservation->status, ['reserved', 'pending', 'expired']) ])>
                    {{ ucfirst($reservation->status) }}
                </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                @if($reservation->status === 'reserved')
                    <a href="{{ route('member.pickup', $reservation->id) }}" class="text-green-600 hover:text-green-900 dark:text-green-400 dark:hover:text-green-300">
                        {{ __('Pick Up') }}
                    </a>
                @elseif($reservation->status === 'pending')
                    <span class="text-gray-500 dark:text-gray-400">
                        {{ __('Cannot Cancel') }}
                    </span>
                @else
                    <a href="{{ route('member.cancel', $reservation->id) }}" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">
                        {{ __('Cancel') }}
                    </a>
                @endif
            </td>
        </tr>
    @endforeach
</tbody>
            </div>
        </div>
    </div>
</x-app-layout>


