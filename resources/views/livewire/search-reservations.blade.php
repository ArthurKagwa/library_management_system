<div>
    <input
        type="text"
        wire:model.live="search"
        class="w-full border border-gray-300 rounded px-4 py-2 text-primary dark:text-primary-dark bg-secondary dark:bg-secondary-dark"
        placeholder="{{ __('Search for a reservation by user name or email...') }}"
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
                                {{ __('Reservation #:id', ['id' => $reservation->id]) }}
                            </div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                {{ __('User: :name (:email)', ['name' => $reservation->user->name, 'email' => $reservation->user->email]) }}
                            </div>
                        </div>
                    @endforeach
                </ul>
            @else
                <div class="p-4 text-gray-500">{{ __('No reservations found') }}</div>
            @endif
        </div>
    @endif

    @if($selectedReservation)
        <div class="mt-4 p-3 bg-green-100 rounded">
            {{ __('Selected: Reservation #:id - :name (:email)', ['id' => $selectedReservation->id, 'name' => $selectedReservation->user->name, 'email' => $selectedReservation->user->email]) }}
        </div>
    @endif
</div>
