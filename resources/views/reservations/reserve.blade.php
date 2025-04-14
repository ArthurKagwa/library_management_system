<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Librarian Book Reservation') }}

        </h2>
        @if (session('success'))
            <div class="mb-4 text-sm text-green-600 dark:text-green-400">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="mb-4 text-sm text-red-600 dark:text-red-400">
                {{ session('error') }}
            </div>
        @endif
    </x-slot>

{{--    @livewire('increase')--}}
    <div class="sm:p-6">
        @livewire('book-reservation-form', ['bookId' => $bookId ?? null])

    </div>



</x-app-layout>
