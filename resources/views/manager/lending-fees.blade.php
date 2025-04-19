<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Lending Fees') }}
        </h2>
    </x-slot>

    <div class="p-12 text-primary dark:text-primary-dark bg-secondary dark:bg-secondary-dark shadow sm:rounded-lg">
        @if($fees->isNotEmpty())
            <h3 class="text-lg font-medium mb-4">{{ __('Lending Fees') }}</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Category</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Duration</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Fee Amount</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200">
                        @foreach($fees as $fee)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $fee->category }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $fee->duration_days }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $fee->fee_amount }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $currentDate = now();
                                    @endphp

                                    @if($currentDate->lt($fee->effective_from))
                                        <span class="text-yellow-500">{{ __('Upcoming') }}</span>
                                    @elseif($fee->effective_to && $currentDate->between($fee->effective_from, $fee->effective_to))
                                        <span class="text-green-500">{{ __('Active') }}</span>
                                    @elseif(!$fee->effective_to || $currentDate->gt($fee->effective_to))
                                        <span class="text-red-500">{{ __('Expired') }}</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{ route('manager.lending-fees.view', $fee->id) }}" class="text-blue-500 hover:underline">{{ __('View') }}</a> |
                                    <a href="{{ route('manager.lending-fees.edit', $fee->id) }}" class="text-green-500 hover:underline">{{ __('Edit') }}</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-gray-500">{{ __('No lending fees available.') }}</p>
        @endif
    </div>
</x-app-layout>
