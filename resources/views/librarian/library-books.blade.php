<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Library Books Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Add New Book Form -->
                    <div class="mb-8">
                        <h3 class="text-lg font-medium mb-4">{{ __('Add New Book') }}</h3>
                        <form action="{{ route('librarian.books.store') }}" method="POST">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <x-input-label for="title" :value="__('Title')" />
                                    <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" required />
                                </div>
                                <div>
                                    <x-input-label for="author" :value="__('Author')" />
                                    <x-text-input id="author" name="author" type="text" class="mt-1 block w-full" required />
                                </div>
                                <div>
                                    <x-input-label for="isbn" :value="__('ISBN')" />
                                    <x-text-input id="isbn" name="isbn" type="text" class="mt-1 block w-full" required />
                                </div>
                                <div>
                                    <x-input-label for="quantity" :value="__('Number of Copies')" />
                                    <x-text-input id="quantity" name="quantity" type="number" min="1" class="mt-1 block w-full" required />
                                </div>
                                <div class="md:col-span-2">
                                    <x-input-label for="description" :value="__('Description')" />
                                   <textarea id="description" name="description" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" rows="3">{{ old('description') }}</textarea>
                                </div>
                                <div>
                                    <x-input-label for="published_date" :value="__('Published Date')" />
                                    <x-text-input id="published_date" name="published_date" type="date" class="mt-1 block w-full" />
                                </div>
                            </div>
                            <div class="mt-4">
                                <x-primary-button>{{ __('Add Book') }}</x-primary-button>
                            </div>
                           <div>
    <x-input-label for="image" :value="__('Book Image')" />
    <input id="image" name="image" type="file" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" accept="image/*" />
</div> 
                        </form>
                    </div>

                    <!-- Books List -->

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
