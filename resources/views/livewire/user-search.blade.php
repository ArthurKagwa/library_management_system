<div>


    <!-- Important: For Livewire 3, use wire:model.live instead of wire:model.debounce -->
    <input
        type="text"
        wire:model.live="search"
        class="w-full border border-gray-300 rounded px-4 py-2 text-primary dark:text-primary-dark bg-secondary dark:bg-secondary-dark"
        placeholder="Search for a user..."
    />

    @if(strlen($search) > 0)
        <div class="mt-2">
            @if(count($results) > 0)
                <ul class="border rounded divide-y cursor-pointer">

                    @foreach($results as $user)
                        <div
                            wire:click="selectUser({{ $user->id }})"
                            class="px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700 "
                        >
                            <div class="font-medium text-gray-900 dark:text-gray-100">{{ $user->name }}</div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ $user->email }}</div>

                        </div>
                    @endforeach
                </ul>

            @endif
        </div>
    @endif

    @if($selectedUser)
        <div class="mt-4 p-3 bg-green-100 rounded">
            Selected: {{ $selectedUser->name }} ({{ $selectedUser->email }})
        </div>
    @endif

</div>


