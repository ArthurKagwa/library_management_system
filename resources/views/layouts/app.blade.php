<!DOCTYPE html>
        <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
            <head>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <meta name="csrf-token" content="{{ csrf_token() }}">

                <title>{{ config('app.name', 'Laravel') }}</title>

                <!-- Fonts -->
                <link rel="preconnect" href="https://fonts.bunny.net">
                <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

                <!-- Scripts -->
                @vite(['resources/css/app.css', 'resources/js/app.js'])
                @livewireStyles
            </head>
            <body class="font-sans antialiased">
                <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
                    <div class="flex flex-col md:flex-row">
                        <!-- Side Navigation -->
                        <x-side-navigation />

                        <!-- Main Content -->
                        <div class="flex-1 md:ml-64">
                            <!-- Top Navigation (if needed) -->
                            @include('layouts.navigation')

                            <!-- Page Heading -->
                            @if (isset($header))
                                <header class="bg-white dark:bg-gray-800 shadow">
                                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                                        {{ $header }}
                                        @if (session('success'))
                                            <div class="mt-4 text-sm text-green-600 dark:text-green-400">
                                                {{ session('success') }}
                                            </div>
                                        @elseif(session('error'))
                                            <div class="mt-4 text-sm text-red-600 dark:text-red-400">
                                                {{ session('error') }}
                                            </div>
                                        @endif
                                    </div>

                                </header>
                            @endif

                            <!-- Page Content -->
                            <main class="py-6">
                                {{ $slot }}
                            </main>
                        </div>
                    </div>
                </div>

                @livewireScripts
                @stack('scripts')
            </body>
        </html>
