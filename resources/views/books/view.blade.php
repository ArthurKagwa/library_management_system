<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-white">
                {{ __('Book Details') }}
            </h2>
            <div class="flex space-x-3">
                <a href="{{ route('member.explore') }}"
                   class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200">
                    {{ __('Back to Explore') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-5xl mx-auto">
            <!-- Glassmorphism Card -->
            <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-lg rounded-2xl shadow-xl overflow-hidden border border-gray-200/30 dark:border-gray-700/30">
                <!-- Book Cover & Basic Info -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 p-8">
                    <!-- Book Cover -->
                    <div class="lg:col-span-1 flex justify-center">
                        <div class="w-64 h-96 bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-800 rounded-xl shadow-lg overflow-hidden flex items-center justify-center">
                            @if($book->image)
                                <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->title }}" class="w-full h-full object-cover">
                            @else
                                <div class="text-center p-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                    <p class="mt-2 text-gray-500 dark:text-gray-400">No cover available</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Book Metadata -->
                    <div class="lg:col-span-2 space-y-6">
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">{{ $book->title }}</h1>
                            <p class="text-xl text-gray-600 dark:text-gray-300 mt-1">by {{ $book->author }}</p>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <!-- ISBN -->
                            <div class="p-4 bg-gray-50/50 dark:bg-gray-700/50 rounded-xl border border-gray-200/30 dark:border-gray-700/30">
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">{{ __('ISBN') }}</label>
                                <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $book->isbn }}</p>
                            </div>

                            <!-- Published Year -->
                            <div class="p-4 bg-gray-50/50 dark:bg-gray-700/50 rounded-xl border border-gray-200/30 dark:border-gray-700/30">
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">{{ __('Published Year') }}</label>
<p class="text-lg font-semibold text-gray-900 dark:text-white">{{ date('Y', strtotime($book->published_date)) }}</p>                            </div>

                            <!-- cat -->
                            <div class="p-4 bg-gray-50/50 dark:bg-gray-700/50 rounded-xl border border-gray-200/30 dark:border-gray-700/30">
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">{{ __('Category') }}</label>
                                <p class="text-lg font-semibold text-gray-900 dark:text-white ">
                                    {{$book->category}}

                                </p>
                            </div>

                            <!-- Availability -->
                            <div class="p-4 bg-gray-50/50 dark:bg-gray-700/50 rounded-xl border border-gray-200/30 dark:border-gray-700/30">
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">{{ __('Availability') }}</label>
                                <p class="text-lg font-semibold {{ $available > 0 ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                                    {{ $available > 0 ? __('Available') : __('Not Available') }}

                                </p>
                            </div>

                            <!-- Action Button -->
                            <div class="p-4 flex items-center justify-center">
                                <a href="{{ route('member.reserve', $book->id) }}"
                                   class="w-full inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-lg shadow-sm text-white bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-200 disabled:opacity-50"
                                   @if($available <= 0) disabled @endif>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z" />
                                    </svg>
                                    {{ __('Reserve') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Description Section -->
                <div class="p-8 border-t border-gray-200/30 dark:border-gray-700/30">
                    <div class="space-y-8">
                        <!-- Original Description -->
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">{{ __('Description') }}</h3>
                            <div class="prose dark:prose-invert max-w-none text-gray-700 dark:text-gray-300">
                                <p class="leading-relaxed">{{ $book->description }}</p>
                            </div>
                        </div>

                        <!-- AI Enhanced Description -->
                        <div class="relative">
                            <div class="absolute -top-4 -right-2">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gradient-to-r from-blue-500 to-indigo-600 text-white shadow-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                    </svg>
                                    AI Enhanced
                                </span>
                            </div>

                            <div class="p-6 rounded-xl bg-gradient-to-r from-blue-50/50 to-indigo-50/50 dark:from-blue-900/20 dark:to-indigo-900/20 border border-blue-200/50 dark:border-blue-800/50">
                                <h3 class="text-xl font-semibold text-blue-800 dark:text-blue-300 mb-4 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd" />
                                    </svg>
                                    {{ __('AI Enhanced Summary') }}
                                </h3>
                                <div class="relative">
                                    @livewire('book-description', ['bookTitle' => $book->title, 'bookAuthor' => $book->author])
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
