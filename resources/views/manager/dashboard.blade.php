<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manager Dashboard') }}
        </h2>
    </x-slot>


    <aside>
        <x-primary-button>
            <a href="staff">
                Staff
            </a>
        </x-primary-button>
        <x-primary-button>
            <a href="{{route('librarian.dashboard')}}">
                Librarian
            </a>
        </x-primary-button>

    </aside>

</x-app-layout>
