<div>
    <div class="text-primary  font-semibold">
        @livewire('user-search')
        <input type="hidden" wire:model="userId">

    </div>

    @if($selectedUser)
        @if( !$selectedUser->hasRole('librarian'))
            <x-primary-button class="mt-4" wire:click="upgradeSelectedUser">
                {{ __('Upgrade to Librarian') }}
            </x-primary-button>
        @else
            <div class="mt-4">
                <div class="text-red-500 dark:text-red-400 font-semibold">
                    {{__('User is already a librarian')}}
                </div>
            </div>
        @endif
    @else
        <div class="mt-4">
            <div class="text-red-500 dark:text-red-400 font-semibold">
                {{__('No user selected')}}
            </div>
        </div>
    @endif

</div>
