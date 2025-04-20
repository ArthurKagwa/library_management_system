<div>
        @if($showingTable)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
            @foreach($stats as $stat)
                <div wire:click="showTable('{{ $stat['title'] }}')" class="cursor-pointer">
                    <livewire:stats-tile
                        :title="$stat['title']"
                        :value="$stat['value']"
                        :icon="$stat['icon'] ?? null"
                        :color="$stat['color'] ?? 'blue'"
                        :duration="$stat['duration'] ?? 1000"
                        :key="$stat['title']"
                    />
                </div>
            @endforeach
        </div>
            <div class="my-4">
                <button wire:click="resetView" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                    {{ __('Back to Stats') }}
                </button>
            </div>

            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                {{ __('Book Title') }}
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                {{ __('Member Name') }}
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                {{ __('Reservation Date') }}
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                {{ __('Status') }}
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                {{ __('Actions') }}
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($filteredReservations as $reservation)
                            <tr>
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">
                                    {{ $reservation->book->title }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400">
                                    {{ $reservation->user->name }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400">
                                    {{ $reservation->created_at->format('Y-m-d H:i:s') }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400">
                                    {{ ucfirst($reservation->status) }}
                                </td>
                                <td class="px-6 py-4 text-sm font-medium">
                                    @if(Auth::user()->hasRole('librarian'))
                                        <a href="{{ route('reservations.edit', $reservation->id) }}" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">
                                            {{ __('Update') }}
                                        </a>
                                    @else
                                        <a href="{{ route('member.reservations.update', $reservation->id) }}" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">
                                            {{ __('Edit') }}
                                        </a>
                                    @endif
                            </tr>
                        @endforeach
                        </tbody>
{{--                        paginatiom--}}

                    </table>
                </div>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                @foreach($stats as $stat)
                    <div wire:click="showTable('{{ $stat['title'] }}')" class="cursor-pointer">
                        <livewire:stats-tile
                            :title="$stat['title']"
                            :value="$stat['value']"
                            :icon="$stat['icon'] ?? null"
                            :color="$stat['color'] ?? 'blue'"
                            :duration="$stat['duration'] ?? 1000"
                            :key="$stat['title']"
                        />
                    </div>
                @endforeach
            </div>
        @endif
    </div>
