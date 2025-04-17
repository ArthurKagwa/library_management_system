<?php

namespace App\Livewire;

use App\Models\Reservation;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class SearchReservations extends Component
{
    public $search = '';
    public $results = [];
    public $selectedReservation = null;

    public function updated($property)
    {
        if ($property === 'search') {
            $this->updateSearch();
        }
    }

    protected function updateSearch()
    {
        Log::info('Search updated', ['term' => $this->search]);

        if (strlen($this->search) > 0) {
            // Find users matching the search term
            $users = User::where('name', 'like', '%' . $this->search . '%')
                ->orWhere('email', 'like', '%' . $this->search . '%')
                ->get();

            // Find reservations related to these users
            $userIds = $users->pluck('id')->toArray();
            $this->results = Reservation::whereIn('user_id', $userIds)->whereIn('status',['ready_for_pickup'])->take(10)->get();
        } else {
            $this->results = [];
        }
    }

    public function clearSearch()
    {
        $this->search = '';
        $this->results = [];
        $this->selectedReservation = null;
    }

    public function selectReservation($reservationId)
    {

        $this->selectedReservation = Reservation::find($reservationId);
        $this->clearSearch();
        $this->dispatch('reservationSelected', reservationId: $reservationId);
    }

    public function render()
    {
        return view('livewire.search-reservations');
    }
}
