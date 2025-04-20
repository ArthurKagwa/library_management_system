<div class="p-4">
    @livewire('book-search')
    <div class="mt-4">
        @if($selectedBook)
{{--            links to borrow or view book--}}
            <div class="flex justify-between items-center">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">
                    {{ $selectedBook->title }}
                </h2>
                <div>
                    <a href="{{ route('view.book', $selectedBook->id) }}" class="text-blue-500 hover:underline">View Book</a>
                    @if($selectedBook->available($selectedBook->id))
                        <a href="{{ route('member.reserve', $selectedBook->id) }}" class="ml-4 text-green-500 hover:underline">Reserve</a>
                    @endif
                </div>
            </div>

        @else
            <div class="text-center">
                <p class="text-gray-600 dark:text-gray-400">Please select a book</p>
            </div>
        @endif
    </div>
</div>
