<div class="py-12 bg-secondary dark:bg-secondary-dark">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-secondary-dark overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 dark:border-gray-700">
            <div class="p-6 bg-white dark:bg-secondary-dark">
                @livewire('checkout-search')

                @if(!is_null($checkin))
                    <div class="mt-6 p-4 border rounded-lg bg-secondary dark:bg-gray-800">
                        <h3 class="text-lg font-semibold text-primary dark:text-primary-dark mb-2">
                            {{ __('Check-in Details') }}
                        </h3>
                        <p class="text-primary dark:text-primary-dark mb-2">
                            <span class="font-medium">{{ __('Checkout Condition:') }}</span>
                            <span class="ml-2 px-2 py-1 rounded-md bg-white dark:bg-gray-700">
                                {{ $checkin->checkout_condition ?? __('Not specified') }}
                            </span>
                        </p>

                        <form wire:submit.prevent="submit" class="mt-6">
                            <div class="mb-4">
                                <label for="returnCondition" class="block text-sm font-medium text-primary dark:text-primary-dark mb-1">
                                    {{ __('Return Condition') }}
                                </label>
                                <select id="returnCondition" wire:model.live="returnCondition"
                                        class="w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm
                                        focus:ring-secondary-accent focus:border-secondary-accent dark:bg-gray-700
                                        dark:text-primary-dark">
                                    <option value="">{{ __('Select Condition') }}</option>
                                    <option value="new">{{ __('New') }}</option>
                                    <option value="good">{{ __('Good') }}</option>
                                    <option value="fair">{{ __('Fair') }}</option>
                                    <option value="poor">{{ __('Poor') }}</option>
                                    <option value="damaged">{{ __('Damaged') }}</option>
                                </select>
                                @error('returnCondition')
                                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <x-primary-button type="submit"
                                                  class="bg-secondary-accent hover:bg-blue-600 text-white px-4 py-2 rounded-md
                                        transition duration-150 ease-in-out focus:outline-none focus:ring-2
                                        focus:ring-offset-2 focus:ring-secondary-accent">
                                    {{ __('Submit') }}
                                </x-primary-button>
                            </div>
                        </form>

                        @if(!is_null($returnCondition))
                            <!-- Display Fine Details -->
                            <div class="mt-8">
                                <h3 class="text-lg font-semibold text-primary dark:text-primary-dark mb-3">
                                    {{ __('Fine Details') }}
                                </h3>

                                @if ($daysExceeded > 0 || $damageLevels > 0 || $fineAmount > 0)
                                    <div class="space-y-2 bg-white dark:bg-gray-700 rounded-lg p-4 border border-gray-200 dark:border-gray-600">
                                        <div class="grid grid-cols-2 gap-2">
                                            <p class="text-primary dark:text-primary-dark">
                                                <span class="font-medium">{{ __('Days Exceeded:') }}</span>
                                            </p>
                                            <p class="text-primary dark:text-primary-dark font-bold">
                                                {{ $daysExceeded }}
                                            </p>

                                            <p class="text-primary dark:text-primary-dark">
                                                <span class="font-medium">{{ __('Damage Levels:') }}</span>
                                            </p>
                                            <p class="text-primary dark:text-primary-dark font-bold">
                                                {{ $damageLevels }}
                                            </p>

                                            <p class="text-primary dark:text-primary-dark">
                                                <span class="font-medium">{{ __('Fine Per Day (Overdue):') }}</span>
                                            </p>
                                            <p class="text-primary dark:text-primary-dark font-bold">
                                                UGX{{ number_format($finePerDay, 2) }}
                                            </p>

                                            <p class="text-primary dark:text-primary-dark">
                                                <span class="font-medium">{{ __('Fine Per Damage Level:') }}</span>
                                            </p>
                                            <p class="text-primary dark:text-primary-dark font-bold">
                                                UGX{{ number_format($finePerCondition, 2) }}
                                            </p>
                                        </div>

                                        <div class="mt-4 pt-3 border-t border-gray-200 dark:border-gray-600">
                                            <p class="text-primary dark:text-primary-dark flex justify-between items-center">
                                                <span class="text-lg font-bold">{{ __('Total Fine:') }}</span>
                                                <span class="text-lg font-bold text-red-600 dark:text-red-400">
                                                    UGX{{ number_format($fineAmount, 2) }}
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                @else
                                    <div class="p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg">
                                        <p class="text-green-800 dark:text-green-400">
                                            {{ __('No applicable fine for this check-in.') }}
                                        </p>
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                @else
                    <div class="mt-6 p-4 bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg">
                        <p class="text-yellow-700 dark:text-yellow-400">
                            {{ __('Please select a check-in record to proceed.') }}
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
