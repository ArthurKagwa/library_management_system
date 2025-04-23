<div class="space-y-4">
    <!-- Search Input -->
    <div>
        <label for="search" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            {{ __('Search for a checkout') }}
        </label>
        <div class="relative">
            <input
                type="text"
                wire:model.live="search"
                id="search"
                class="w-full pl-10 pr-8 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-400"
                placeholder="Search by user, book, or date..."
            />
            <!-- Search Icon -->
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>

        </div>
    </div>

    <!-- Search Results -->
    @if(strlen($search) > 0)
        <div class="mt-2">
            @if(count($results) > 0)
                <ul class="border border-gray-200 dark:border-gray-600 rounded-lg divide-y divide-gray-200 dark:divide-gray-700 bg-white dark:bg-gray-700 shadow-sm">
                    @foreach($results as $checkout)
                        <li
                            wire:click="selectCheckout({{ $checkout->id }})"
                            class="px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-600 cursor-pointer transition-colors duration-150"
                        >
                            <div class="flex justify-between items-start">
                                <div>
                                    <div class="font-medium text-gray-900 dark:text-gray-100">{{ $checkout->user->name }}</div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                        {{ __('Book: ') }}<span class="font-medium">{{ $checkout->book->title }}</span>
                                    </div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">
                                        {{ __('Checkout Date: ') }}<span class="font-medium">{{ $checkout->checkout_date->format('M d, Y') }}</span>
                                    </div>
                                </div>
                                <div class="text-xs font-bold px-2 py-1 rounded
                                    @if(is_null($checkout->return_date))
                                        @if($checkout->due_date < now())
                                            text-orange-800 bg-orange-100 dark:bg-orange-900/30 dark:text-orange-200
                                        @else
                                            text-red-800 bg-red-100 dark:bg-red-900/30 dark:text-red-200
                                        @endif
                                    @else
                                        text-green-800 bg-green-100 dark:bg-green-900/30 dark:text-green-200
                                    @endif">
                                    @if(is_null($checkout->return_date))
                                        @if($checkout->due_date < now())
                                            {{ __('Overdue') }}
                                        @else
                                            {{ __('Checked Out') }}
                                        @endif
                                    @else
                                        {{ __('Returned') }}
                                    @endif
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    @endif

    <!-- Selected Checkout -->
    @if($selectedCheckout)
        <div class="mt-4 p-3 bg-green-50 dark:bg-green-900/20 border border-green-100 dark:border-green-800 rounded-lg">
            <div class="font-medium text-green-800 dark:text-green-200">{{ __('Selected Checkout') }}</div>
            <div class="text-gray-900 dark:text-gray-100 mt-1">{{ $selectedCheckout->user->name }}</div>
            <div class="text-sm text-gray-600 dark:text-gray-300">
                {{ $selectedCheckout->book->title }} ({{ $selectedCheckout->checkout_date->format('M d, Y') }})
            </div>
        </div>
    @endif
</div>
