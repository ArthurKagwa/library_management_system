<?php

namespace App\Livewire;

use App\Models\Book;
use Livewire\Component;

class BookSearch extends Component
{

    public $search = '';
    public $results = [];
    public $selectedBook = null;

    public function updated($property)
    {
        if ($property === 'search') {
            $this->updateSearch();
        }
    }

    protected function updateSearch()
    {
        if (strlen($this->search) > 0) {
            $this->results = Book::where('title', 'like', '%' . $this->search . '%')
                ->orWhere('author', 'like', '%' . $this->search . '%')
                ->take(5)
                ->get();
        } else {
            $this->results = [];
        }
    }
    public function selectBook($bookId)
    {
//        $this->selectedBookId =$bookId;
        $this->selectedBook = Book::find($bookId);
        $this->search = $this->selectedBook->title ?? '';
        $this->results = [];
        $this->dispatch('bookSelected', $bookId); // Add this line

    }

    public function render()
    {
        return view('livewire.book-search');
    }
}
