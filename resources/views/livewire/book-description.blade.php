<div class="book-description">
    @if(empty($description))
        <div class="flex justify-between items-center">
            <p class="text-primary dark:text-primary-dark italic">No description available</p>
            <button wire:click="generateDescription" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
                Generate Description
            </button>
        </div>
    @else
        <div>
            <p class="text-primary dark:text-primary-dark">{{ $description }}</p>
            <button wire:click="generateDescription" class="mt-2 text-sm text-blue-500 hover:text-blue-700">
                Regenerate
            </button>
        </div>
    @endif

    @if($isLoading)
        <div class="flex justify-center mt-2">
            <div class="loader">Generating description...</div>
        </div>
    @endif
</div>
