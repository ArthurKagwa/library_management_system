<!-- resources/views/components/dashboard-card.blade.php -->
@props(['title', 'value', 'icon' => 'check', 'color' => 'blue'])

@php
    $colors = [
        'blue' => 'bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-100',
        'green' => 'bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-100',
        'yellow' => 'bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-100',
        'red' => 'bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-100'
    ];
@endphp

<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full {{ $colors[$color] }} mr-4">
                <x-icon :name="$icon" class="h-6 w-6" />
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ $title }}</p>
                <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $value }}</p>
            </div>
        </div>
    </div>
</div>
