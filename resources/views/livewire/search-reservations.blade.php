<div class="relative">
    <!-- Search Input -->
    <div class="relative">
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 dark:text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
            </svg>
        </div>
        <input
            type="text"
            wire:model.live="search"
            class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-500 dark:focus:border-blue-500 text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-700 placeholder-gray-400 dark:placeholder-gray-400 transition duration-150 ease-in-out"
            placeholder="{{ __('Search for a reservation by user name or email...') }}"
            autocomplete="off"
        />

    </div>

    <!-- Search Results -->
    @if(strlen($search) > 0)
        <div class="mt-2 relative">
            @if(count($results) > 0)
                <ul class="absolute z-10 w-full bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg shadow-lg overflow-hidden divide-y divide-gray-200 dark:divide-gray-600 max-h-96 overflow-y-auto">
                    @foreach($results as $reservation)
                        <li
                            wire:click="selectReservation({{ $reservation->id }})"
                            class="px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors duration-150 cursor-pointer"
                        >
                            <div class="flex items-center justify-between">
                                <div class="font-medium text-gray-900 dark:text-gray-100">
                                    {{ __('Reservation #:id', ['id' => $reservation->id]) }}
                                </div>
                                <div class="text-xs px-2 py-1 bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 rounded-full">
                                    {{ $reservation->status }}
                                </div>
                            </div>
                            <div class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                {{ $reservation->user->name }} &middot; {{ $reservation->user->email }}
                            </div>
                            @if($reservation->book)
                                <div class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                    {{ $reservation->book->title }} ({{ $reservation->book->author }})
                                </div>
                            @endif
                            <div class="text-xs text-gray-400 dark:text-gray-500 mt-2">
                                {{ __('Created: :date', ['date' => $reservation->created_at->format('M d, Y')]) }}
                            </div>
                        </li>
                    @endforeach
                </ul>
            @else
                <div class="absolute z-10 w-full bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg shadow-lg p-4 text-center text-gray-500 dark:text-gray-400">
                    {{ __('No reservations found for ":search"', ['search' => $search]) }}
                </div>
            @endif
        </div>
    @endif

    <!-- Selected Reservation -->
    @if($selectedReservation)
        <div class="mt-4 p-3 bg-green-50 dark:bg-green-900/30 border border-green-100 dark:border-green-800 rounded-lg">
            <div class="flex items-start justify-between">
                <div>
                    <div class="font-medium text-green-800 dark:text-green-200">
                        {{ __('Selected Reservation') }}
                    </div>
                    <div class="text-gray-900 dark:text-gray-100 mt-1">
                        #{{ $selectedReservation->id }} &middot;
                        <span class="text-sm px-2 py-0.5 bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 rounded-full ml-1">
                            {{ $selectedReservation->status }}
                        </span>
                    </div>
                    <div class="text-sm text-gray-600 dark:text-gray-300 mt-1">
                        {{ $selectedReservation->user->name }} &middot; {{ $selectedReservation->user->email }}
                    </div>
                    @if($selectedReservation->book)
                        <div class="text-sm text-gray-600 dark:text-gray-300 mt-1">
                            {{ $selectedReservation->book->title }} ({{ $selectedReservation->book->author }})
                        </div>
                    @endif
                </div>
                <button
                    wire:click="clearSelection"
                    class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200"
                    aria-label="{{ __('Clear selection') }}"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
            <div class="flex items-center text-xs text-gray-500 dark:text-gray-400 mt-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                {{ __('Created: :date', ['date' => $selectedReservation->created_at->format('M d, Y H:i')]) }}
            </div>
        </div>
    @endif
</div>
