<div>


    <!-- Important: For Livewire 3, use wire:model.live instead of wire:model.debounce -->
    <input
        type="text"
        wire:model.live="search"
        class="w-full border border-gray-300 rounded px-4 py-2 text-primary dark:text-primary-dark bg-secondary dark:bg-secondary-dark"
        placeholder="Search for a book..."
    />

    @if(strlen($search) > 0)
        <div class="mt-2">
            @if(count($results) > 0)
                <ul class="border rounded divide-y cursor-pointer">

                    @foreach($results as $book)
                        <div
                            wire:click="selectBook({{ $book->id }})"
                            class="px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700 "
                        >
                            <div class="font-medium text-gray-900 dark:text-gray-100">{{ $book->title }}</div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ $book->author }}</div>

                        </div>
                    @endforeach
                </ul>

            @endif
        </div>
    @endif

    @if($selectedBook)
        <div class="mt-4 p-3 bg-green-100 rounded">
            {{__('Selected: ')}} {{ $selectedBook->title }} ({{ $selectedBook->author }})
        </div>
    @endif

</div>


