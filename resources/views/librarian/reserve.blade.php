<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Librarian Book Reservation') }}

        </h2>
    </x-slot>

{{--    @livewire('increase')--}}

    @livewire('book-reservation-form', ['bookId' => $bookId ?? null])



</x-app-layout>
