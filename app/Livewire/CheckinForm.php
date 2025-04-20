<?php

namespace App\Livewire;

use App\Models\Checkout;
use Livewire\Component;

class CheckinForm extends Component
{
    public $checkinId;
    public $checkin;

    //fields
    public $returnCondition;
    public $returnDate;
    public $fineAmount;


    protected  $listeners = [
        'checkinSelected' => 'setCheckin',
    ];
    public function setCheckin($checkinId)
    {
        $this->checkinId = $checkinId;
        $this->checkin = Checkout::find($checkinId);
    }
    public function render()
    {
        return view('livewire.checkin-form');
    }
}
