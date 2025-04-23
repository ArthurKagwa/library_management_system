<div class="p-6 bg-white dark:bg-gray-800 shadow-sm rounded-lg space-y-6">
    <!-- Search Section -->
    <div>
        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-3">Search Reservations</h3>
        <livewire:search-reservations />
    </div>

    <!-- Selected Reservation Display -->
    @if ($selectedReservation && $selectedReservation->status == 'ready_for_pickup')
        <div class="p-4 bg-blue-50 dark:bg-blue-900/20 border border-blue-100 dark:border-blue-800 rounded-lg">
            <h4 class="font-medium text-blue-800 dark:text-blue-200 mb-2">Selected Reservation</h4>
            <div class="space-y-1 text-sm">
                <p class="text-gray-700 dark:text-gray-300">
                    <span class="font-medium">Member:</span> {{ $selectedReservation->user->name }}
                </p>
                <p class="text-gray-700 dark:text-gray-300">
                    <span class="font-medium">Book:</span> {{ $selectedReservation->book->title }}
                </p>
                <p class="text-gray-700 dark:text-gray-300">
                    <span class="font-medium">Reserved:</span> {{ $selectedReservation->created_at->format('M d, Y') }}
                </p>
                <p class="text-gray-700 dark:text-gray-300">
                    <span class="font-medium">Copy ID:</span> {{ optional($selectedReservation->bookCopy)->id ?? 'N/A' }}
                </p>
                <p class="text-gray-700 dark:text-gray-300">
                    <span class="font-medium">Status:</span>
                    <span class="capitalize px-2 py-1 rounded text-xs
                        @if($selectedReservation->status == 'ready_for_pickup')
                            bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-200
                        @endif">
                        {{ str_replace('_', ' ', $selectedReservation->status) }}
                    </span>
                </p>
            </div>
        </div>
    @else
        <div class="p-4 bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 rounded-lg">
            <p class="text-gray-500 dark:text-gray-400">No reservation selected. Please search and select a reservation above.</p>
        </div>
    @endif

    <!-- Status Messages -->
    @if ($successMessage)
        <div class="p-4 bg-green-50 dark:bg-green-900/20 border border-green-100 dark:border-green-800 rounded-lg text-green-700 dark:text-green-300">
            {{ $successMessage }}
        </div>
    @endif

    @if ($errorMessage)
        <div class="p-4 bg-red-50 dark:bg-red-900/20 border border-red-100 dark:border-red-800 rounded-lg text-red-700 dark:text-red-300">
            {{ $errorMessage }}
        </div>
    @endif

    <!-- Checkout Form -->
    <form wire:submit.prevent="completeCheckout" class="space-y-6">
        @if($selectedReservation)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Duration Selection -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Duration of loan</label>
                    <select wire:model.live="duration" class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="">Select Duration</option>
                        <option value="7">1 Week</option>
                        <option value="14">2 Weeks</option>
                        <option value="30">1 Month</option>
                    </select>

                    <!-- Fee Display -->
                    @if ($base_fee > 0)
                        <p class="text-sm text-gray-700 dark:text-gray-300 mt-2">
                            <span class="font-medium">Base Fee:</span> UGX {{ number_format($base_fee, 2) }}
                        </p>
                    @else
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-2 italic">
                            Base Fee will be calculated based on the duration selected.
                        </p>
                    @endif
                </div>
            </div>
        @endif

        <!-- Submit Button -->
        <div class="flex justify-end">
            <button
                type="submit"
                class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 disabled:opacity-50 disabled:cursor-not-allowed"
                {{ $selectedReservation ? '' : 'disabled' }}
            >
                Complete Checkout
            </button>
        </div>
    </form>
</div>
