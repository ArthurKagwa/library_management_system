<?php

namespace App\Livewire;

use App\Models\Book;
use App\Models\Checkout;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class CheckoutSearch extends Component
{
    public $search = '';
    public $results = [];
    public $selectedCheckout = null;

    public function updated($property)
    {
        if ($property === 'search') {
            $this->updateSearch();
        }
    }

    protected function updateSearch()
    {
        // Log for debugging
        Log::info('Search updated', ['term' => $this->search]);

        if (strlen($this->search) > 0) {
            //search checkoouts by usename and email
            $this->results = Checkout::whereHas('user', function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            })->orWhereHas('book', function ($query) {
                    $query->where('title', 'like', '%' . $this->search . '%');
                })
                ->take(5)
                ->get();
        } else {
            $this->results = [];
        }
    }
    public function selectCheckout($checkoutId)
    {
        $this->selectedCheckout = Checkout::find($checkoutId);
        $this->search = $this->selectedCheckout->title ?? ' ';
        $this->results = [];
        $this->dispatch('checkoutSelected', bookId: $checkoutId);

    }

    public function render()
    {
        return view('livewire.checkout-search');
    }
}
