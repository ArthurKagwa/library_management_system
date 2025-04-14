<?php

namespace App\Livewire;

use Livewire\Component;

class StatsTile extends Component
{
    public $title;
    public $value;
    public $icon;
    public $color;
    public $duration = 1000; // Animation duration in milliseconds

    public function mount($title, $value, $icon = null, $color = 'blue', $duration = 1000)
    {
        $this->title = $title;
        $this->value = $value;
        $this->icon = $icon;
        $this->color = $color;
        $this->duration = $duration;
    }

    public function render()
    {
        return view('livewire.stats-tile');
    }
}
