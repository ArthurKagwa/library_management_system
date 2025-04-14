<!-- resources/views/livewire/book-reservation-form.blade.php -->
<div>
    <form wire:submit.prevent="submit" class="space-y-4">
        @csrf

        <!-- Book Selection -->
        <div>
            @if($bookId)
                <input type="hidden" wire:model="bookId">
                <div class="p-3 bg-green-100 rounded mb-4">
                    Selected Book: {{ $selectedBook->title }} by {{ $selectedBook->author }}
                </div>
            @else
                <livewire:book-search />
                <input type="hidden" wire:model="bookId">
            @endif
            @error('bookId') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- User Selection -->
        <div>
            <livewire:user-search />
            <input type="hidden" wire:model="userId">
            @error('userId') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Date Selection -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <x-input-label for="pickup_date" :value="__('Pickup Date')" />
                <x-text-input wire:model="pickupDate" id="pickup_date" name="pickup_date" type="date"
                              class="mt-1 block w-full" min="{{ now()->format('Y-m-d') }}" required />
                @error('pickupDate') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <x-input-label for="return_date" :value="__('Return Date')" />
                <x-text-input wire:model="returnDate" id="return_date" name="return_date" type="date"
                              class="mt-1 block w-full" min="{{ now()->addDay()->format('Y-m-d') }}" required />
                @error('returnDate') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- Form Actions -->
        <div class="flex justify-end space-x-3">
            <x-secondary-button type="button" onclick="window.history.back()">
                {{ __('Cancel') }}
            </x-secondary-button>
            <x-primary-button type="submit">
                {{ __('Confirm Reservation') }}
            </x-primary-button>
        </div>
    </form>
</div>
