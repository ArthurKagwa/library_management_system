<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Lending Fee Details') }}
        </h2>
    </x-slot>

    <div class="p-12 text-primary dark:text-primary-dark bg-secondary dark:bg-secondary-dark shadow sm:rounded-lg">
        <h3 class="text-lg font-medium mb-4">{{ __('Lending Fee Details') }}</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200">
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900 dark:text-gray-100">{{ __('Category') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-700 dark:text-gray-400">{{ $fee->category }}</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900 dark:text-gray-100">{{ __('Duration (days)') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-700 dark:text-gray-400">{{ $fee->duration_days }}</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900 dark:text-gray-100">{{ __('Fee Amount') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-700 dark:text-gray-400">{{ $fee->fee_amount }}</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900 dark:text-gray-100">{{ __('Effective From') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-700 dark:text-gray-400">{{ $fee->effective_from->format('Y-m-d') }}</td>
                    </tr>
                    @if($fee->effective_to)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900 dark:text-gray-100">{{ __('Effective To') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-700 dark:text-gray-400">{{ $fee->effective_to->format('Y-m-d') }}</td>
                        </tr>
                    @endif
                </tbody>
            </table>

            <div class="mt-4">
                <a href="{{ route('manager.lending-fees.edit', $fee->id) }}" class="text-green-500 hover:underline">{{ __('Edit') }}</a>
</x-app-layout>
