<?php

namespace App\Livewire;

use Livewire\Component;

class Increase extends Component
{
    public $number=0;

    public function increment()
    {
        $this->number++;
    }

    public function render()
    {
        return view('livewire.increase');
    }
}
