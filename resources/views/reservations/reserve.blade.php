<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            @if(Auth::check() && Auth::user()->hasRole('librarian'))
                {{ __('Librarian Book Reservations') }}
            @else
                {{ __('Member Book Reservations') }}
            @endif
        </h2>

    </x-slot>

{{--    @livewire('increase')--}}
    <div class="sm:p-6">
        @livewire('book-reservation-form', ['bookId' => $bookId ?? null])

    </div>



</x-app-layout>
