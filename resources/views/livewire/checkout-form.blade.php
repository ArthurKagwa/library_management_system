<div class="p-6 bg-white dark:bg-gray-800 shadow-sm rounded-lg">
    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Checkout Process</h3>

    <div class="mb-6">
        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-2">Search Reservations</h3>
        <livewire:search-reservations />
    </div>

    @if ($selectedReservation)
        <div class="mb-6 p-4 bg-blue-50 dark:bg-blue-900/30 rounded-lg">
            <h4 class="font-medium">Selected Reservation</h4>
            <p>Member: {{ $selectedReservation->user->name }}</p>
            <p>Book: {{ $selectedReservation->book->title }}</p>
            <p>Status: <span class="capitalize">{{ str_replace('_', ' ', $selectedReservation->status) }}</span></p>
        </div>
    @else
        <div class="mb-6 p-4 bg-gray-100 dark:bg-gray-700 rounded-lg">
            <p class="text-gray-500 dark:text-gray-400">No reservation selected. Please search and select a reservation above.</p>
        </div>
    @endif

    @if ($successMessage)
        <div class="mb-6 p-4 bg-green-50 dark:bg-green-900/30 text-green-700 dark:text-green-300 rounded-lg">
            {{ $successMessage }}
        </div>
    @endif

    @if ($errorMessage)
        <div class="mb-6 p-4 bg-red-50 dark:bg-red-900/30 text-red-700 dark:text-red-300 rounded-lg">
            {{ $errorMessage }}
        </div>
    @endif

    <form wire:submit.prevent="completeCheckout">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Duration of loan</label>
                <select wire:model="duration" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
                    <option value="">Select Duration</option>
                    <option value="7">1 Week</option>
                    <option value="14">2 Weeks</option>
                    <option value="30">1 Month</option>
                </select>
            </div>
        </div>
        <span class="text-sm text-gray-500 dark:text-gray-400 italic">{{ __('Base Fee will be calculated based on the duration selected.') }}</span>

        <div class="flex justify-end">
            <button
                type="submit"
                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                {{ $selectedReservation ? '' : 'disabled' }}
                >
                Complete Checkout
            </button>
        </div>
    </form>
</div>
