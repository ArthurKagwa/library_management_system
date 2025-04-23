<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Library Books Management') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                <div class="p-6 sm:p-8">
                    <!-- Add New Book Form -->
                    <div class="mb-8">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-6 pb-2 border-b border-gray-200 dark:border-gray-700">
                            {{ __('Add New Book') }}
                        </h3>

                        <form action="{{ route('librarian.books.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Title -->
                                <div>
                                    <x-input-label for="title" :value="__('Title')" class="mb-1" />
                                    <x-text-input id="title" name="title" type="text" class="w-full" required />
                                </div>

                                <!-- Author -->
                                <div>
                                    <x-input-label for="author" :value="__('Author')" class="mb-1" />
                                    <x-text-input id="author" name="author" type="text" class="w-full" required />
                                </div>

                                <!-- ISBN -->
                                <div>
                                    <x-input-label for="isbn" :value="__('ISBN')" class="mb-1" />
                                    <x-text-input id="isbn" name="isbn" type="text" class="w-full" required />
                                </div>

                                <!-- Quantity -->
                                <div>
                                    <x-input-label for="quantity" :value="__('Number of Copies')" class="mb-1" />
                                    <x-text-input id="quantity" name="quantity" type="number" min="1" class="w-full" required />
                                </div>

                                <!-- Published Date -->
                                <div>
                                    <x-input-label for="published_date" :value="__('Published Date')" class="mb-1" />
                                    <x-text-input id="published_date" name="published_date" type="date" class="w-full" />
                                </div>

                                <!-- Book Image -->
                                <div>
                                    <x-input-label for="image" :value="__('Book Image')" class="mb-1" />
                                    <input id="image" name="image" type="file"
                                           class="w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm
                                              focus:border-indigo-500 focus:ring-indigo-500
                                              file:mr-4 file:py-2 file:px-4
                                              file:rounded-md file:border-0
                                              file:text-sm file:font-semibold
                                              file:bg-indigo-50 dark:file:bg-indigo-900/30
                                              file:text-indigo-700 dark:file:text-indigo-300
                                              hover:file:bg-indigo-100 dark:hover:file:bg-indigo-900/40"
                                           accept="image/*" />
                                </div>

                                <!-- Description -->
                                <div class="md:col-span-2">
                                    <x-input-label for="description" :value="__('Description')" class="mb-1" />
                                    <textarea id="description" name="description"
                                              class="w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm
                                                 focus:border-indigo-500 focus:ring-indigo-500
                                                 dark:bg-gray-700 dark:text-gray-100"
                                              rows="4">{{ old('description') }}</textarea>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="mt-6 flex justify-end">
                                <x-primary-button class="px-6 py-3">
                                    {{ __('Add Book') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
