<?php
namespace App\Repositories;

use App\Models\Book;

class BookRepository {
    public function getMostOverdueBooks() {
        return Book::whereHas('rentals', function ($query) {
            $query->whereNull('returned_on')->where('due_date', '<', now());
        })->get();
    }

    public function getMostPopularBook() {
        return Book::withCount('rentals')->orderBy('rentals_count', 'desc')->first();
    }

    public function getLeastPopularBook() {
        return Book::withCount('rentals')->orderBy('rentals_count', 'asc')->first();
    }
}