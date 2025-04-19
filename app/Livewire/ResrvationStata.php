<?php

namespace App\Livewire;

use App\Models\Reservation;
use Illuminate\Support\Str;
use Livewire\Component;

class ResrvationStata extends Component
{
    public $stats = [];
    public $filteredReservations = [];
    public $showingTable = false;

    public function mount($stats = [])
    {
        $this->stats = $stats;
    }

    public function resetView()
    {
        $this->filteredReservations = [];
        $this->showingTable = false;
    }

    public function showTable($title)
    {

        $this->filteredReservations = Reservation::with(['book', 'user'])
            ->where('status', Str::snake($title))
            ->get();
        $this->showingTable = true;
    }

    public function render()
    {
        return view('livewire.resrvation-stata', [
            'filteredReservations' => $this->filteredReservations,
            'showingTable' => $this->showingTable,
        ]);
    }
}
