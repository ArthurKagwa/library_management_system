<?php

namespace App\Livewire;

use App\Models\Book;
use Livewire\Component;

class ExploreSearch extends Component
{
    public $selectedBook = null;
    public $bookId = null;

    protected  $listeners = [
        'bookSelected' => 'handleBookSelected'
    ];

    public function mount()
    {
        $this->selectedBook = null;
        $this->bookId = null;
    }

    public function resetBook()
    {
        $this->selectedBook = null;
        $this->bookId = null;
    }
    public function handleBookSelected($bookId)
    {
        $this->bookId = $bookId;
        $this->selectedBook = Book::find($bookId);
    }
    public function render()
    {
        return view('livewire.explore-search');
    }
}
