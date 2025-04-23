<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                {{ __('Edit Lending Fee') }}
            </h2>
            <a href="{{ route('manager.lending-fees.view', $fee->id) }}"
               class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200">
                {{ __('View Details') }}
            </a>
        </div>
    </x-slot>

    <div class="py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <!-- Glassmorphism Card -->
            <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-lg rounded-2xl shadow-xl overflow-hidden border border-gray-200/30 dark:border-gray-700/30">
                <!-- Card Header -->
                <div class="px-6 py-5 border-b border-gray-200/30 dark:border-gray-700/30 bg-gradient-to-r from-blue-50/50 to-indigo-50/50 dark:from-gray-700/50 dark:to-gray-800/50">
                    <div class="flex items-center">
                        <div class="p-3 rounded-lg bg-indigo-100 dark:bg-indigo-900/50 text-indigo-600 dark:text-indigo-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white">{{ $fee->category }}</h3>
                            <p class="text-sm text-indigo-600 dark:text-indigo-400">Editing Lending Fee Structure</p>
                        </div>
                    </div>
                </div>

                <!-- Card Content -->
                <div class="px-6 py-5">
                    <form method="POST" action="{{ route('manager.lending-fees.update', $fee->id) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Category (Read-only) -->
                            <div class="p-4 bg-gray-50/50 dark:bg-gray-700/50 rounded-xl border border-gray-200/30 dark:border-gray-700/30">
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">{{ __('Category') }}</label>
                                <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $fee->category }}</p>
                                <input type="hidden" name="category" value="{{ $fee->category }}">
                            </div>

                            <!-- Duration (Read-only) -->
                            <div class="p-4 bg-gray-50/50 dark:bg-gray-700/50 rounded-xl border border-gray-200/30 dark:border-gray-700/30">
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">{{ __('Duration (days)') }}</label>
                                <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $fee->duration_days }}</p>
                                <input type="hidden" name="duration_days" value="{{ $fee->duration_days }}">
                            </div>

                            <!-- Fee Amount -->
                            <div class="p-4 bg-gray-50/50 dark:bg-gray-700/50 rounded-xl border border-gray-200/30 dark:border-gray-700/30">
                                <label for="fee_amount" class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">{{ __('Fee Amount') }}</label>
                                <div class="relative mt-1 rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 dark:text-gray-400">UGX</span>
                                    </div>
                                    <input type="number"
                                           id="fee_amount"
                                           name="fee_amount"
                                           value="{{ old('fee_amount', $fee->fee_amount) }}"
                                           required
                                           class="block w-full pl-12 pr-3 py-2 border border-gray-300/50 dark:border-gray-600/50 rounded-lg bg-white/50 dark:bg-gray-700/50 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200">
                                </div>
                            </div>

                            <!-- Effective From -->
                            <div class="p-4 bg-gray-50/50 dark:bg-gray-700/50 rounded-xl border border-gray-200/30 dark:border-gray-700/30">
                                <label for="effective_from" class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">{{ __('Effective From') }}</label>
                                <input type="date"
                                       id="effective_from"
                                       name="effective_from"
                                       value="{{ old('effective_from', $fee->effective_from->format('Y-m-d')) }}"
                                       required
                                       class="mt-1 block w-full px-3 py-2 border border-gray-300/50 dark:border-gray-600/50 rounded-lg bg-white/50 dark:bg-gray-700/50 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200">
                            </div>

                            <!-- Effective To -->
                            <div class="p-4 bg-gray-50/50 dark:bg-gray-700/50 rounded-xl border border-gray-200/30 dark:border-gray-700/30">
                                <label for="effective_to" class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">{{ __('Effective To') }}</label>
                                <input type="date"
                                       id="effective_to"
                                       name="effective_to"
                                       value="{{ old('effective_to', $fee->effective_to ? $fee->effective_to->format('Y-m-d') : '') }}"
                                       class="mt-1 block w-full px-3 py-2 border border-gray-300/50 dark:border-gray-600/50 rounded-lg bg-white/50 dark:bg-gray-700/50 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200">
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="flex items-center justify-between pt-6">
                            <a href="{{ route('manager.lending-fees') }}" class="text-sm font-medium text-indigo-600 dark:text-indigo-400 hover:text-indigo-500 dark:hover:text-indigo-300 transition-colors duration-200">
                                {{ __('Back to Fees') }}
                            </a>
                            <button type="submit"
                                    class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg shadow-sm text-white bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                {{ __('Update Fee Structure') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
