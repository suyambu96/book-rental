<?php

namespace App\Services;

use App\Repositories\BookRepository;

class StatsService {
    protected $bookRepo;

    public function __construct(BookRepository $bookRepo) {
        $this->bookRepo = $bookRepo;
    }

    public function getMostOverdueBooks() {
        return $this->bookRepo->getMostOverdueBooks();
    }

    public function getMostPopularBook() {
        return $this->bookRepo->getMostPopularBook();
    }

    public function getLeastPopularBook() {
        return $this->bookRepo->getLeastPopularBook();
    }
}