<style>
/* Hide scrollbar but keep scrolling */
.custom-scrollbar {
    scrollbar-width: none; /* For Firefox */
    -ms-overflow-style: none; /* For Internet Explorer and Edge */
}

.custom-scrollbar::-webkit-scrollbar {
    display: none; /* For Chrome, Safari, and Opera */
}
</style>

<div x-data="{ open: false }" class="relative">
    <!-- Side Navigation -->
    <nav class="bg-gradient-to-b from-blue-500 via-gray-400 to-pink-500 dark:from-gray-800 dark:via-gray-700 dark:to-gray-600 text-white shadow-lg
                md:fixed md:h-full md:w-64
                absolute w-full z-40 transition-all duration-300 ease-in-out transform
                overflow-y-auto custom-scrollbar"
         :class="{'translate-x-0': open, '-translate-x-full md:translate-x-0': !open}">
        <div class="p-5">
            <div class="flex items-center justify-between md:justify-start text-primary dark:text-primary-dark ">
                <div class="flex items-center">
                    <h1 class="text-xl font-bold ml-2">{{ env('APP_NAME') }}</h1>
                </div>
                <button @click="open = false" class="md:hidden text-gray-500 hover:text-primary focus:outline-none">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="mt-8">
                <!-- Member links -->
                @if(auth()->check() && auth()->user()->hasRole('member'))
                    <div class="mt-4 mb-2 px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">
                        Member Area
                    </div>

                    <a href="{{ route('member.dashboard') }}"
                       class="flex items-center px-4 py-2 mb-2 rounded-md {{ request()->routeIs('member.dashboard') ? 'bg-secondary-accent text-white' : 'text-primary bg-secondary dark:text-primary-dark dark:bg-secondary-dark hover:bg-gray-100 dark:hover:bg-primary' }}">
                        <x-icon name="book" class="w-5 h-5 mr-3" />
                        <span>Dashboard</span>
                    </a>

                    <a href="{{ route('member.explore') }}"
                       class="flex items-center px-4 py-2 mb-2 rounded-md {{ request()->routeIs('member.explore') ? 'bg-secondary-accent text-white' : 'text-primary bg-secondary dark:text-primary-dark dark:bg-secondary-dark hover:bg-gray-100 dark:hover:bg-primary' }}">
                        <x-icon name="search" class="w-5 h-5 mr-3" />
                        <span>Explore Books</span>
                    </a>

                    <a href="{{ route('member.books.reserve') }}"
                       class="flex items-center px-4 py-2 mb-2 rounded-md {{ request()->routeIs('member.books.reserve') ? 'bg-secondary-accent text-white' : 'text-primary bg-secondary dark:text-primary-dark dark:bg-secondary-dark hover:bg-gray-100 dark:hover:bg-primary' }}">
                        <x-icon name="bookmark" class="w-5 h-5 mr-3" />
                        <span>Reserve Book</span>
                    </a>

                    <a href="{{ route('member.my-reservations') }}"
                       class="flex items-center px-4 py-2 mb-2 rounded-md {{ request()->routeIs('member.my-reservations') ? 'bg-secondary-accent text-white' : 'text-primary bg-secondary dark:text-primary-dark dark:bg-secondary-dark hover:bg-gray-100 dark:hover:bg-primary' }}">
                        <x-icon name="clock" class="w-5 h-5 mr-3" />
                        <span>View Reservations</span>
                    </a>

                    <a href="{{ route('member.checkouts') }}"
                       class="flex items-center px-4 py-2 mb-2 rounded-md {{ request()->routeIs('member.checkouts') ? 'bg-secondary-accent text-white' : 'text-primary bg-secondary dark:text-primary-dark dark:bg-secondary-dark hover:bg-gray-100 dark:hover:bg-primary' }}">
                        <x-icon name="shopping-cart" class="w-5 h-5 mr-3" />
                        <span>My Checkouts</span>
                    </a>

                   
                @endif

                <!-- Librarian links -->
                @if(auth()->check() && auth()->user()->hasRole('librarian'))
                    <div class="mt-4 mb-2 px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">
                        Librarian Area
                    </div>

                    <a href="{{ route('librarian.dashboard') }}"
                       class="flex items-center px-4 py-2 mb-2 rounded-md {{ request()->routeIs('librarian.dashboard') ? 'bg-secondary-accent text-white' : 'text-primary bg-secondary dark:text-primary-dark dark:bg-secondary-dark hover:bg-gray-100 dark:hover:bg-primary' }}">
                        <x-icon name="book" class="w-5 h-5 mr-3" />
                        <span>Dashboard</span>
                    </a>

                    <a href="{{ route('librarian.books.index') }}"
                       class="flex items-center px-4 py-2 mb-2 rounded-md {{ request()->routeIs('librarian.books.index') ? 'bg-secondary-accent text-white' : 'text-primary bg-secondary dark:text-primary-dark dark:bg-secondary-dark hover:bg-gray-100 dark:hover:bg-primary' }}">
                        <x-icon name="plus-circle" class="w-5 h-5 mr-3" />
                        <span>Add Books</span>
                    </a>

                    <a href="{{ route('librarian.checkout') }}"
                       class="flex items-center px-4 py-2 mb-2 rounded-md {{ request()->routeIs('librarian.checkout') ? 'bg-secondary-accent text-white' : 'text-primary bg-secondary dark:text-primary-dark dark:bg-secondary-dark hover:bg-gray-100 dark:hover:bg-primary' }}">
                        <x-icon name="shopping-cart" class="w-5 h-5 mr-3" />
                        <span>Checkout</span>
                    </a>

                    <a href="{{ route('librarian.checkin') }}"
                       class="flex items-center px-4 py-2 mb-2 rounded-md {{ request()->routeIs('librarian.checkin') ? 'bg-secondary-accent text-white' : 'text-primary bg-secondary dark:text-primary-dark dark:bg-secondary-dark hover:bg-gray-100 dark:hover:bg-primary' }}">
                        <x-icon name="check-circle" class="w-5 h-5 mr-3" />
                        <span>Check In</span>
                    </a>

                    <a href="{{ route('librarian.books.reserve') }}"
                       class="flex items-center px-4 py-2 mb-2 rounded-md {{ request()->routeIs('librarian.books.reserve') ? 'bg-secondary-accent text-white' : 'text-primary bg-secondary dark:text-primary-dark dark:bg-secondary-dark hover:bg-gray-100 dark:hover:bg-primary' }}">
                        <x-icon name="bookmark" class="w-5 h-5 mr-3" />
                        <span>Reserve Book</span>
                    </a>

                    <a href="{{ route('librarian.reservations.index') }}"
                       class="flex items-center px-4 py-2 mb-2 rounded-md {{ request()->routeIs('librarian.reservations.index') ? 'bg-secondary-accent text-white' : 'text-primary bg-secondary dark:text-primary-dark dark:bg-secondary-dark hover:bg-gray-100 dark:hover:bg-primary' }}">
                        <x-icon name="clock" class="w-5 h-5 mr-3" />
                        <span>View Reservations</span>
                    </a>
                @endif

                <!-- Manager links -->
                @if(auth()->check() && auth()->user()->hasRole('manager'))
                    <div class="mt-4 mb-2 px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">
                        Manager Area
                    </div>

                    <a href="{{ route('manager.dashboard') }}"
                       class="flex items-center px-4 py-2 mb-2 rounded-md {{ request()->routeIs('manager.dashboard') ? 'bg-secondary-accent text-white' : 'text-primary bg-secondary dark:text-primary-dark dark:bg-secondary-dark hover:bg-gray-100 dark:hover:bg-primary' }}">
                        <x-icon name="check-circle" class="w-5 h-5 mr-3" />
                        <span>Dashboard</span>
                    </a>

                    <a href="{{ route('manager.staff') }}"
                       class="flex items-center px-4 py-2 mb-2 rounded-md {{ request()->routeIs('manager.staff') ? 'bg-secondary-accent text-white' : 'text-primary bg-secondary dark:text-primary-dark dark:bg-secondary-dark hover:bg-gray-100 dark:hover:bg-primary' }}">
                        <x-icon name="users" class="w-5 h-5 mr-3" />
                        <span>Manage Staff</span>
                    </a>

                    <a href="{{ route('manager.lending-fees') }}"
                       class="flex items-center px-4 py-2 mb-2 rounded-md {{ request()->routeIs('manager.lending-fees') ? 'bg-secondary-accent text-white' : 'text-primary bg-secondary dark:text-primary-dark dark:bg-secondary-dark hover:bg-gray-100 dark:hover:bg-primary' }}">
                        <x-icon name="dollar-sign" class="w-5 h-5 mr-3" />
                        <span>Lending Fees</span>
                    </a>
                @endif

                <!-- Logout -->
                <div class="mt-6">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex w-full items-center px-4 py-2 rounded-md text-red-600 hover:bg-red-100 dark:hover:bg-red-900">
                            <svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </div>
            <form action="{{ route('force.logout') }}" method="POST">
    @csrf
    <button type="submit">Force Logout</button>
</form>

        </div>
    </nav>
</div>