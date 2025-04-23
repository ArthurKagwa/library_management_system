<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manager Dashboard') }}
        </h2>
    </x-slot>

    <div class="grid grid-cols-2 gap-4 p-6">
        <div class="bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 text-center p-6 rounded-lg shadow-lg hover:bg-blue-200 dark:hover:bg-blue-600 aspect-square">
            <a href="manager.staff" class="block">
                <h3 class="text-lg font-semibold">Staff</h3>
            </a>
        </div>
        <div class="bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 text-center p-6 rounded-lg shadow-lg hover:bg-blue-200 dark:hover:bg-blue-600 aspect-square">
            <a class="block">
                <h3 class="text-lg font-semibold">Librarian</h3>
            </a>
        </div>
        <div class="bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 text-center p-6 rounded-lg shadow-lg hover:bg-blue-200 dark:hover:bg-blue-600 aspect-square">
            <a  class="block">
                <h3 class="text-lg font-semibold">Members</h3>
                <p class="text-sm mt-2">{{ $stats['total_users'] }} Members</p>
            </a>
        </div>
    </div>
    @isset($stats)
        <div class="grid grid-cols-2 gap-4 p-6">
            <div class="bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 text-center p-6 rounded-lg shadow-lg hover:bg-blue-200 dark:hover:bg-blue-600 aspect-square">
                <h3 class="text-lg font-semibold">Total Books</h3>
                <p class="text-sm mt-2">{{ $stats['total_books'] }} Books</p>
            </div>
            <div class="bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 text-center p-6 rounded-lg shadow-lg hover:bg-blue-200 dark:hover:bg-blue-600 aspect-square">
                <h3 class="text-lg font-semibold">Total Members</h3>
                <p class="text-sm mt-2">{{ $stats['total_users'] }} Members</p>
            </div>
            <div class="bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 text-center p-6 rounded-lg shadow-lg hover:bg-blue-200 dark:hover:bg-blue-600 aspect-square">
                <h3 class="text-lg font-semibold">Loaned Books</h3>
                <p class="text-sm mt-2">{{ $stats['loanedBooks'] }} Books</p>
            </div>
        </div>

    @endisset
    
</x-app-layout>