<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{__( 'View Checkout')}}
        </h2>
    </x-slot>


    <div class="p-6 text-primary dark:text-primary-dark ">

        @if($checkout)

            <div  class="max-w-md mx-auto bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">{{ __('Checkout Details') }}</h3>
                    @if($checkout)
                        <div class="mb-2">
                            <span class="font-medium text-primary dark:text-primary-dark">{{ __('Book Title:') }}</span>
                            <span class="text-gray-800 dark:text-gray-200">{{ $checkout->book?->title ?? __('N/A') }}</span>
                        </div>
                        <div class="mb-2">
                            <span class="font-medium text-primary dark:text-primary-dark">{{ __('Author:') }}</span>
                            <span class="text-gray-800 dark:text-gray-200">{{ $checkout->book?->author ?? __('N/A') }}</span>
                        </div>
                        <div class="mb-2">
                            <span class="font-medium text-primary dark:text-primary-dark">{{ __('Copy ID:') }}</span>
                            <span class="text-gray-800 dark:text-gray-200">{{ $checkout->book_copy_id ?? __('N/A') }}</span>
                        </div>
                        <div class="mb-2">
                            <span class="font-medium text-primary dark:text-primary-dark">{{ __('Due Date:') }}</span>
                            <span class="text-gray-800 dark:text-gray-200">{{ $checkout->due_date?->format('Y-m-d') ?? __('N/A') }}</span>
                        </div>
                        <div class="mb-2">
                            <span class="font-medium text-primary dark:text-primary-dark">{{ __('Status:') }}</span>
                            @if($checkout->due_date?->isToday())
                                <span class="text-yellow-500 font-semibold">{{ __('Due Today') }}</span>
                            @elseif($checkout->due_date?->isFuture())
                                <span class="text-green-500 font-semibold">{{ __('On Time') }}</span>
                            @else
                                <span class="text-red-500 font-semibold">{{ __('Overdue') }}</span>
                            @endif
                        </div>
                    @else
                        <p class="text-red-500">{{ __('No checkout details available.') }}</p>
                    @endif
                </div>
            </div>

        @else
            <div class="text-center text-gray-500 dark:text-gray-400 font-medium">
                {{ __('No Checkout found') }}
            </div>
        @endif


    </div>


</x-app-layout>
