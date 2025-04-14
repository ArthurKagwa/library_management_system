<?php

namespace App\Livewire;

use Livewire\Component;

class Stats extends Component
{
    public $stats = [];

    public function mount($stats = [])
    {
        $this->stats = $stats;
    }

    public function render()
    {
        return view('livewire.stats');
    }
}
