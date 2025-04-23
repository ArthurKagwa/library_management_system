<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manager Dashboard') }}
        </h2>
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-6">
        <!-- Main action tiles with gradient backgrounds and icons -->
        <div class="bg-gradient-to-br from-indigo-500 to-purple-600 dark:from-indigo-600 dark:to-purple-800 text-white rounded-xl shadow-xl transition-all duration-300 transform hover:scale-105 hover:shadow-2xl">
            <a href="manager.staff" class="block p-6">
                <div class="flex flex-col items-center">
                    <div class="mb-4 bg-white/20 p-3 rounded-full">
                        <!-- You can replace this with an actual SVG icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold">Staff</h3>
                    <p class="text-white/80 mt-2">Manage staff members</p>
                </div>
            </a>
        </div>

        <div class="bg-gradient-to-br from-blue-500 to-teal-500 dark:from-blue-600 dark:to-teal-600 text-white rounded-xl shadow-xl transition-all duration-300 transform hover:scale-105 hover:shadow-2xl">
            <a class="block p-6">
                <div class="flex flex-col items-center">
                    <div class="mb-4 bg-white/20 p-3 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold">Librarian</h3>
                    <p class="text-white/80 mt-2">Library management</p>
                </div>
            </a>
        </div>

        <div class="bg-gradient-to-br from-amber-500 to-pink-500 dark:from-amber-600 dark:to-pink-600 text-white rounded-xl shadow-xl transition-all duration-300 transform hover:scale-105 hover:shadow-2xl">
            <a class="block p-6">
                <div class="flex flex-col items-center">
                    <div class="mb-4 bg-white/20 p-3 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold">Members</h3>
                    <p class="text-white/80 mt-2">{{ $stats['total_users'] ?? '0' }} Total members</p>
                </div>
            </a>
        </div>
    </div>

    @isset($stats)
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 px-6 pb-6">
            <!-- Stats cards with glass morphism effect -->
            <div class="bg-white/10 backdrop-blur-lg dark:bg-gray-800/50 border border-gray-200 dark:border-gray-700 rounded-lg p-6 relative overflow-hidden group">
                <div class="absolute inset-0 bg-gradient-to-r from-blue-400/20 to-indigo-400/20 transform group-hover:scale-105 transition-transform duration-300 rounded-lg"></div>
                <div class="relative flex items-center space-x-4">
                    <div class="bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-300 p-3 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-800 dark:text-gray-200">Total Books</h3>
                        <p class="text-2xl font-bold text-blue-600 dark:text-blue-400">{{ $stats['total_books'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white/10 backdrop-blur-lg dark:bg-gray-800/50 border border-gray-200 dark:border-gray-700 rounded-lg p-6 relative overflow-hidden group">
                <div class="absolute inset-0 bg-gradient-to-r from-purple-400/20 to-pink-400/20 transform group-hover:scale-105 transition-transform duration-300 rounded-lg"></div>
                <div class="relative flex items-center space-x-4">
                    <div class="bg-purple-100 dark:bg-purple-900/30 text-purple-600 dark:text-purple-300 p-3 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-800 dark:text-gray-200">Total Members</h3>
                        <p class="text-2xl font-bold text-purple-600 dark:text-purple-400">{{ $stats['total_users'] }}</p>
                    </div>
                </div>
            </div>



            <div class="bg-white/10 backdrop-blur-lg dark:bg-gray-800/50 border border-gray-200 dark:border-gray-700 rounded-lg p-6 relative overflow-hidden group">
                <div class="absolute inset-0 bg-gradient-to-r from-amber-400/20 to-orange-400/20 transform group-hover:scale-105 transition-transform duration-300 rounded-lg"></div>
                <div class="relative flex items-center space-x-4">
                    <div class="bg-amber-100 dark:bg-amber-900/30 text-amber-600 dark:text-amber-300 p-3 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-800 dark:text-gray-200">Loaned Books</h3>
                        <p class="text-2xl font-bold text-amber-600 dark:text-amber-400">{{ $stats['loanedBooks'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white/10 backdrop-blur-lg dark:bg-gray-800/50 border border-gray-200 dark:border-gray-700 rounded-lg p-6 relative overflow-hidden group">
                <div class="absolute inset-0 bg-gradient-to-r from-amber-400/20 to-orange-400/20 transform group-hover:scale-105 transition-transform duration-300 rounded-lg"></div>
                <div class="relative flex items-center space-x-4">
                    <div class="bg-amber-100 dark:bg-amber-900/30 text-amber-600 dark:text-amber-300 p-3 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-800 dark:text-gray-200">{{ __('Checkouts in ') . now()->format('F') }}</h3>
                        <p class="text-2xl font-bold text-amber-600 dark:text-amber-400">{{ $stats['checkouts'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white/10 backdrop-blur-lg dark:bg-gray-800/50 border border-gray-200 dark:border-gray-700 rounded-lg p-6 relative overflow-hidden group">
                <div class="absolute inset-0 bg-gradient-to-r from-indigo-400/20 to-purple-400/20 transform group-hover:scale-105 transition-transform duration-300 rounded-lg"></div>
                <div class="relative flex items-center space-x-4">
                    <div class="bg-amber-100 dark:bg-amber-900/30 text-amber-600 dark:text-indigo-300 p-3 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-800 dark:text-gray-200">{{ __('Checkins in ') . now()->format('F') }}</h3>
                        <p class="text-2xl font-bold text-amber-600 dark:text-amber-400">{{ $stats['checkins'] }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endisset
</x-app-layout>
