<div class="max-w-2xl mx-auto p-6 bg-white dark:bg-gray-800 rounded-xl shadow-lg transition-colors duration-300 border border-gray-200 dark:border-gray-700">
    <form wire:submit.prevent="submit" class="space-y-6">
        @csrf

        <!-- Book Selection Card -->
        <div class="bg-white dark:bg-gray-700 p-5 rounded-xl shadow-sm hover:shadow-md transition-all duration-300 border border-gray-100 dark:border-gray-600">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-3 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-500" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z" />
                </svg>
                Select a Book
            </h3>

            @if($bookId)
                <input type="hidden" wire:model="bookId">
                <div class="flex items-center space-x-4 p-3 bg-blue-50 dark:bg-gray-600 rounded-lg border border-blue-100 dark:border-gray-500">
                    @if($selectedBook->cover_url)
                        <img src="{{ $selectedBook->cover_url }}" alt="Book Cover" class="w-12 h-16 object-cover rounded shadow-sm">
                    @else
                        <div class="w-12 h-16 bg-gray-200 dark:bg-gray-500 rounded flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                    @endif
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 dark:text-white truncate">{{ $selectedBook->title }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-300 truncate">by {{ $selectedBook->author }}</p>
                    </div>
                    <button type="button" wire:click="$set('bookId', null)" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            @else
                <livewire:book-search />
                <input type="hidden" wire:model="bookId">
            @endif
            @error('bookId') <p class="mt-1 text-xs text-red-500 dark:text-red-400">{{ $message }}</p> @enderror
        </div>

        <!-- User Selection Card (for librarians) -->
        @if(Auth::user()->hasRole('librarian'))
            <div class="bg-white dark:bg-gray-700 p-5 rounded-xl shadow-sm hover:shadow-md transition-all duration-300 border border-gray-100 dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-3 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                    </svg>
                    User Selection
                </h3>
                <livewire:user-search />
                <input type="hidden" wire:model="userId">
                @error('userId') <p class="mt-1 text-xs text-red-500 dark:text-red-400">{{ $message }}</p> @enderror
            </div>
        @else
            <input type="hidden" wire:model="userId" value="{{ Auth::user()->id }}">
        @endif

        <!-- Reservation Info Card -->
        <div class="bg-white dark:bg-gray-700 p-5 rounded-xl shadow-sm hover:shadow-md transition-all duration-300 border border-gray-100 dark:border-gray-600">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-3 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-500" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                </svg>
                Reservation Details
            </h3>

            <div class="grid grid-cols-1 gap-4">
                <div>
                    <label for="reservation_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Reservation Date</label>
                    <div class="relative">
                        <input wire:model="reservationDate" id="reservation_date" name="reservation_date" type="date"
                               class="w-full rounded-lg border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-600 dark:text-white dark:placeholder-gray-400 px-4 py-2 border"
                               min="{{ now()->format('Y-m-d') }}" required>
                        @error('reservationDate')
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        @enderror
                    </div>
                    @error('reservationDate') <p class="mt-1 text-xs text-red-500 dark:text-red-400">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="flex justify-end space-x-3 pt-2">
            <button type="button" onclick="window.history.back()"
                    class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-gray-800 transition-colors duration-200">
                Cancel
            </button>
            <button type="submit" wire:loading.attr="disabled"
                    class="px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-gray-800 transition-colors duration-200 disabled:opacity-75 flex items-center">
                <span wire:loading wire:target="submit" class="mr-2">
                    <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </span>
                <span wire:loading.remove wire:target="submit">Confirm Reservation</span>
                <span wire:loading wire:target="submit">Processing...</span>
            </button>
        </div>
    </form>
</div>
