<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <aside>
        <x-primary-button>
            <a href="manageStaff">
                Staff
            </a>
        </x-primary-button>

    </aside>

</x-app-layout>
