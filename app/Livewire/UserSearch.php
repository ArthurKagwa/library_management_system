<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Log;
use Livewire\Component;
use App\Models\User;

class UserSearch extends Component
{
    public $search = '';
    public $results = [];
    public $selectedUser = null;


    public function updated($property)
    {
        if ($property === 'search') {
            $this->updateSearch();
        }
    }

    //clear search
    public function clearSearch()
    {
        $this->search = '';
        $this->results = [];
        $this->selectedUser = null;
    }

    protected function updateSearch()
    {
        // Log for debugging
        Log::info('Search updated', ['term' => $this->search]);

        if (strlen($this->search) > 0) {
            $this->results = User::where('name', 'like', '%' . $this->search . '%')->orWhere('email', 'like', '%' . $this->search . '%')
                ->take(5)
                ->get();
        } else {
            $this->results = [];
        }
    }

    // app/Http/Livewire/UserSearch.php
    public function selectUser($userId)
    {
        $this->selectedUser = User::find($userId);
        $this->search = $this->selectedUser->name ?? '';
        $this->results = [];
        $this->dispatch('userSelected', userId: $userId);

    }

    public function render()
    {
        return view('livewire.user-search');
    }
}

