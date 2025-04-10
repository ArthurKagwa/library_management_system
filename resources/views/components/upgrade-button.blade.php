@props(['user'])

@if(auth()->user()->hasRole('manager') && $user->hasRole('member'))
    <form method="POST" action="{{ route('manager.users.upgrade', $user) }}">
        @csrf
        <button type="submit"
                class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 text-sm"
                onclick="return confirm('Are you sure you want to upgrade this user to librarian?')">
            Upgrade to Librarian
        </button>
    </form>
@endif
