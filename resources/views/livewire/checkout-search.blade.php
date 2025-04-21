<div>


    <label for="search" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
        {{ __('Search for a checkout') }}
    </label>
    <input
        type="text"
        wire:model.live="search"
        class="w-full border border-gray-300 rounded px-4 py-2 text-primary dark:text-primary-dark bg-secondary dark:bg-secondary-dark"
        placeholder="Search for a checkout..."
    />

    @if(strlen($search) > 0)
        <div class="mt-2">
            @if(count($results) > 0)
                 <ul class="border rounded divide-y cursor-pointer">

                    @foreach($results as $checkout)
                        <div
                            wire:click="selectCheckout({{ $checkout->id }})"
                            class="px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700 "
                        >
                            <div class="font-medium text-gray-900 dark:text-gray-100">{{ $checkout->user->name }}</div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ __('Checkout Date: ') . $checkout->checkout_date->format('Y-m-d') }}</div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ __('Book: ') . $checkout->book->title }}</div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">
                               <div class="text-sm font-bold px-2 py-1 rounded
                                    @if(is_null($checkout->return_date))
                                        @if($checkout->due_date < now())
                                            text-orange-500 bg-orange-50
                                        @else
                                            text-red-500 bg-red-50
                                        @endif
                                    @else
                                        text-green-500 bg-green-50
                                    @endif">
                                    @if(is_null($checkout->return_date))
                                        @if($checkout->due_date < now())
                                            {{ __('Status: Overdue') }}
                                        @else
                                            {{ __('Status: Checked Out') }}
                                        @endif
                                    @else
                                        {{ __('Status: Returned') }}
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </ul>

            @endif
        </div>
    @endif

    @if($selectedCheckout)
        <div class="mt-4 p-3 bg-green-100 rounded">
            {{__('Selected: ')}} {{ $selectedCheckout->user->name }} ({{ $selectedCheckout->book->title.' ) - '. $selectedCheckout->checkout_date->format('Y-m-d') }}
        </div>
    @endif

</div>


