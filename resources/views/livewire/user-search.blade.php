<div class="relative">
    <!-- Search Input -->
    <div class="relative">
        <input
            type="text"
            wire:model.live="search"
            class="w-full pl-10 pr-8 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-blue-500 focus:border-blue-500 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-400"
            placeholder="Search for a user..."
            autocomplete="off"
        />
        <!-- Search Icon -->
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <svg class="h-5 w-5 text-gray-400 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </div>

    </div>

    <!-- Search Results -->
    @if(strlen($search) > 0)
        <div class="mt-2">
            @if(count($results) > 0)
                <ul class="border border-gray-200 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700 shadow-lg">
                    @foreach($results as $user)
                        <li
                            wire:click="selectUser({{ $user->id }})"
                            class="px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer flex items-center"
                        >
                            <!-- User Avatar -->
                            @if($user->profile_image)
                                <img src="{{ asset('storage/' . $user->profile_image) }}"
                                     alt="{{ $user->name }}"
                                     class="w-10 h-10 rounded-full mr-3 object-cover">
                            @else
                                <!-- Fallback Initials Avatar -->
                                <div class="w-10 h-10 rounded-full bg-gray-200 dark:bg-gray-600 flex items-center justify-center mr-3">
            <span class="text-gray-600 dark:text-gray-300 font-medium">
                {{ substr($user->name, 0, 1) }}
            </span>
                                </div>
                            @endif

                            <!-- User Info -->
                            <div>
                                <div class="font-medium text-gray-900 dark:text-gray-100">{{ $user->name }}</div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">{{ $user->email }}</div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    @endif

    <!-- Selected User -->
    @if($selectedUser)
        <div class="mt-4 p-3 bg-green-50 dark:bg-green-900/20 border border-green-100 dark:border-green-800 rounded-lg">
            <div class="font-medium text-green-800 dark:text-green-200">Selected:</div>
            <div class="text-gray-900 dark:text-gray-100">{{ $selectedUser->name }}</div>
            <div class="text-sm text-gray-600 dark:text-gray-300">{{ $selectedUser->email }}</div>
        </div>
    @endif
</div>
