<?php

namespace App\Livewire;

use App\Models\Book;
use Livewire\Component;
use Illuminate\Support\Facades\Log;

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
        // Log for debugging
        Log::info('Search updated', ['term' => $this->search]);

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
        $this->selectedBook = Book::find($bookId);
        $this->search = $this->selectedBook->title ?? ' ';
        $this->results = [];
        $this->dispatch('bookSelected', bookId: $bookId);

    }

    public function render()
    {
        return view('livewire.book-search');
    }
}
