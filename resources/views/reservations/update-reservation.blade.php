<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Librarian Reservations Handling') }}
        </h2>
        @if (session('success'))
            <div class="mb-4 text-sm text-green-600 dark:text-green-400">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="mb-4 text-sm text-red-600 dark:text-red-400">
                {{ session('error') }}
            </div>
        @endif
    </x-slot>



    <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-4 dark:text-primary-dark">
        <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
            <h3 class="text-lg font-semibold mb-4">{{ __('Update Reservation') }}</h3>

            @if(Auth::check() && Auth::user()->hasRole('librarian'))

                <form method="POST" action="{{ route('reservations.update', $reservation->id) }}">
            @else
                <form method="POST" action="{{ route('member.reservations.update', $reservation->id) }}">
            @endif

                        @csrf
                @method('PATCH')

                <!-- Hidden fields to maintain user, book, and reservation date -->
                <input type="hidden" name="user_id" value="{{ $reservation->user_id }}">

                    <input type="hidden" name="book_id" value="{{ $reservation->book_id }}">
                <div class="mb-4">
                        <x-input-label for="reservation_date" :value="__('Reservation Date')" />
                        <x-text-input id="reservation_date" name="reservation_date" type="datetime-local"
                                      class="mt-1 block w-full"
                                       required />
                        @error('reservation_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                @if(Auth::check() && Auth::user()->hasRole('librarian'))

                <input type="hidden" name="librarian_id" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="reservation_date" value="{{ $reservation->reservation_date ? date('Y-m-d\TH:i', strtotime($reservation->reservation_date)) : now()->format('Y-m-d\TH:i') }}">

                    <div class="mb-4">
                        <x-input-label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Status') }}</x-input-label>
                        <select id="status" name="status" class="w-full border-primary-dark dark:border-primary dark:bg-secondary-dark dark:text-primary-dark focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            <option value="pending" {{ $reservation->status === 'pending' ? 'selected' : '' }}>{{ __('Pending') }}</option>
                            <option value="ready_for_pickup" {{ $reservation->status === 'ready_for_pickup' ? 'selected' : '' }}>{{ __('Ready for Pickup') }}</option>
                            <option value="picked_up" {{ $reservation->status === 'picked_up' ? 'selected' : '' }}>{{ __('Picked Up') }}</option>
                            <option value="expired" {{ $reservation->status === 'expired' ? 'selected' : '' }}>{{ __('Expired') }}</option>
                            <option value="cancelled" {{ $reservation->status === 'cancelled' ? 'selected' : '' }}>{{ __('Cancelled') }}</option>
                        </select>
                        @error('status') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-4">
                        <x-input-label for="book_copy_id" :value="__('Copy ID')" />
                        <select id="book_copy_id" name="book_copy_id" class="mt-1 block w-full" required>
                            @if ($reservation->book_copy_id)
                                <option value="{{ $reservation->book_copy_id }}" selected>
                                    {{ __('Current Copy #:') }} {{ $reservation->book_copy_id }}
                                </option>
                            @endif

                            @if (!empty($availableCopies))
                                @foreach ($availableCopies as $copy)
                                    @if ($reservation->book_copy_id != $copy->id)
                                        <option value="{{ $copy->id }}">
                                            {{ __('Copy #:') }} {{ $copy->copy_number }}
                                        </option>
                                    @endif
                                @endforeach
                            @elseif (!$reservation->book_copy_id)
                                <option value="">{{ __('Not Available') }}</option>
                            @endif
                        </select>
                        @error('book_copy_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                @else
                    <div class="mb-4">
{{--                        change status to cancel--}}
                        <div class="mb-4 border border-gray-300 dark:border-gray-700 p-4 rounded-md bg-gray-50 dark:bg-gray-900">
                            Change status to "Cancel" to cancel the reservation.
                        </div>
                          <x-input-label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Status') }}</x-input-label>
                          <select id="status" name="status" class="w-full border-primary-dark dark:border-primary dark:bg-secondary-dark dark:text-primary-dark focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                              <option value="pending" {{ $reservation->status === 'pending' ? 'selected' : '' }}>{{ __('Pending') }}</option>
                              <option value="cancelled" {{ $reservation->status === 'cancelled' ? 'selected' : '' }}>{{ __('Cancel') }}</option>
                          </select>
                          @error('status') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                      </div>
                  @endif



                @if(Auth::check() && Auth::user()->hasRole('librarian'))
                        <div class="mb-4">
                            <x-input-label for="ready_for_pickup_date" :value="__('Ready for Pickup Date')" />
                            <x-text-input id="ready_for_pickup_date" name="ready_for_pickup_date" type="datetime-local"
                                          class="mt-1 block w-full"
                                          value="{{ $reservation->ready_for_pickup_date ? date('Y-m-d\TH:i', strtotime($reservation->ready_for_pickup_date)) : old('ready_for_pickup_date') }}" required />
                            @error('ready_for_pickup_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                    <div class="mb-4">
                        <x-input-label for="pickup_deadline" :value="__('Pickup Deadline')" />
                        <x-text-input id="pickup_deadline" name="pickup_deadline" type="datetime-local"
                                      class="mt-1 block w-full"
                                      value="{{ $reservation->pickup_deadline ? date('Y-m-d\TH:i', strtotime($reservation->pickup_deadline)) : old('pickup_deadline') }}" required />
                        @error('pickup_deadline') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-4">
                        <label for="notification_sent" class="inline-flex items-center">
                            <input type="checkbox" id="notification_sent" name="notification_sent" value="1"
                                   class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                {{ $reservation->notification_sent ? 'checked' : '' }}>
                            <span class="ml-2 text-sm text-gray-600 dark:text-gray-300">{{ __('Notification Sent') }}</span>
                        </label>
                        @error('notification_sent') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                @endif



                <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 focus:outline-none focus:ring focus:ring-blue-200">
                    @if(Auth::check() && Auth::user()->hasRole('librarian'))

                        {{ __('Update Reservation') }}

                    @else
                        {{ __('Confirm Reservation Date' ) }}
                    @endif
                </button>
            </form>

        </div>
        <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
           <h3 class="text-lg font-semibold mb-4">{{ __('Reservation Details') }}</h3>
           <div class="grid grid-cols-1 gap-3">
               <div class="border-b border-gray-200 dark:border-gray-700 pb-2">
                   <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase mb-2">{{ __('Book Information') }}</h4>
                   <p class="mb-1"><strong class="font-medium">{{ __('Title:') }}</strong> {{ $reservation->book->title }}</p>
                   <p class="mb-1"><strong class="font-medium">{{ __('Author:') }}</strong> {{ $reservation->book->author }}</p>
                   <p><strong class="font-medium">{{ __('ISBN:') }}</strong> {{ $reservation->book->isbn }}</p>
               </div>

               <div class="border-b border-gray-200 dark:border-gray-700 pb-2">
                   <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase mb-2">{{ __('Member Information') }}</h4>
                   <p class="mb-1"><strong class="font-medium">{{ __('Name:') }}</strong> {{ $reservation->user->name }}</p>
                   <p><strong class="font-medium">{{ __('Email:') }}</strong> {{ $reservation->user->email }}</p>
               </div>

               <div>
                   <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase mb-2">{{ __('Reservation Status') }}</h4>
                   <p class="mb-1"><strong class="font-medium">{{ __('Created:') }}</strong> {{ $reservation->created_at->format('Y-m-d H:i:s') }}</p>
                   <p class="mb-1"><strong class="font-medium">{{ __('Reservation Date:') }}</strong> {{ $reservation->reservation_date->format('Y-m-d H:i:s') }}</p>

                   <p class="mb-1"><strong class="font-medium">{{ __('Status:') }}</strong>
                       <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                           {{ $reservation->status === 'pending' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200' :
                              ($reservation->status === 'ready_for_pickup' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200' :
                              ($reservation->status === 'picked_up' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' :
                              'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200')) }}">
                           {{ ucfirst(str_replace('_', ' ', $reservation->status)) }}
                       </span>
                   </p>
                   @if($reservation->book_copy_id)
                       <p class="mb-1"><strong class="font-medium">{{ __('Copy:') }}</strong> #{{ $reservation->book_copy_id }}</p>
                   @endif
                   @if($reservation->ready_for_pickup_date)
                       <p class="mb-1"><strong class="font-medium">{{ __('Ready Date:') }}</strong> {{ $reservation->ready_for_pickup_date->format('Y-m-d H:i:s') }}</p>
                   @endif
                   @if($reservation->pickup_deadline)
                       <p class="flex items-center">
                           <strong class="font-medium">{{ __('Deadline:') }}</strong>
                           <span class="ml-1 {{ now() > $reservation->pickup_deadline ? 'text-red-600 dark:text-red-400' : '' }}">
                               {{ $reservation->pickup_deadline->format('Y-m-d H:i:s') }}
                           </span>
                       </p>
                   @endif
               </div>
           </div>
       </div>
    </div>
</x-app-layout>
