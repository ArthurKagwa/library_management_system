<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Check In Book') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-secondary-dark overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-secondary-dark border-b border-gray-200">
                    @livewire('checkout-search')
                </div>
            </div>
        </div>

</x-app-layout>
