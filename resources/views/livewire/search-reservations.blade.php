<div>
    <input
        type="text"
        wire:model.live="search"
        class="w-full border border-gray-300 rounded px-4 py-2"
        placeholder="Search for a reservation by user name or email..."
    />

    @if(strlen($search) > 0)
        <div class="mt-2">
            @if(count($results) > 0)
                <ul class="border rounded divide-y cursor-pointer">
                    @foreach($results as $reservation)
                        <div
                            wire:click="selectReservation({{ $reservation->id }})"
                            class="px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700"
                        >
                            <div class="font-medium text-gray-900 dark:text-gray-100">
                                Reservation #{{ $reservation->id }}
                            </div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                User: {{ $reservation->user->name }} ({{ $reservation->user->email }})
                            </div>
                        </div>
                    @endforeach
                </ul>
            @else
                <div class="p-4 text-gray-500">No reservations found</div>
            @endif
        </div>
    @endif

    @if($selectedReservation)
        <div class="mt-4 p-3 bg-green-100 rounded">
            Selected: Reservation #{{ $selectedReservation->id }} -
            {{ $selectedReservation->user->name }} ({{ $selectedReservation->user->email }})
        </div>
    @endif
</div>
