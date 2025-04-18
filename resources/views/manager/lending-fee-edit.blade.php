<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Lending Fee Edit') }}
        </h2>
    </x-slot>

    <div class="p-12 text-primary dark:text-primary-dark bg-secondary dark:bg-secondary-dark shadow sm:rounded-lg">
        <h3 class="text-lg font-medium mb-4">{{ __('Edit Lending Fee') }}</h3>
        <form method="POST" action="{{ route('manager.lending-fees.update', $fee->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="category" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Category') }}</label>
                <input type="text" name="category" id="category" value="{{ old('category', $fee->category) }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300">
            </div>

            <div class="mb-4">
                <label for="duration_days" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Duration (days)') }}</label>
                <input type="number" name="duration_days" id="duration_days" value="{{ old('duration_days', $fee->duration_days) }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300">
            </div>

            <div class="mb-4">
                <label for="fee_amount" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Fee Amount') }}</label>
                <input type="number" name="fee_amount" id="fee_amount" value="{{ old('fee_amount', $fee->fee_amount) }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300">
            </div>

            <div class="mb-4">
                <label for="effective_from" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Effective From') }}</label>
                <input type="date" name="effective_from" id="effective_from" value="{{ old('effective_from', $fee->effective_from->format('Y-m-d')) }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300">
            </div>

            <div class="mb-4">
                <label for="effective_to" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Effective To') }}</label>
                <input type="date" name="effective_to" id="effective_to"
                       value="{{ old('effective_to', $fee->effective_to ? $fee->effective_to->format('Y-m-d') : '') }}"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300">
            </div>
            <div class="mb-4">
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 active:bg-blue-600 transition ease-in-out duration-150">
                    {{ __('Update Fee') }}
                </button>
            </div>
        </form>
        <div class="mt-4">
            <a href="{{ route('manager.lending-fees.view', $fee->id) }}" class="text-gray-500 hover:underline">{{ __('View Fee Details') }}</a>
        </div>
    </div>

</x-app-layout>
