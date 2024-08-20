<?php

namespace App\Services;

use App\Models\Book;
use App\Models\Rental;
use App\Models\User;

class RentalService
{
    public function createRental($userId, $bookId)
    {
        $user = User::find($userId);
        $book = Book::find($bookId);

        if (!$user || !$book) {
            return null; // or throw an exception, depending on your design
        }

        $rental = new Rental();
        $rental->user_id = $userId;
        $rental->book_id = $bookId;
        $rental->rented_on = now();
        $rental->due_date = now()->addDays(14); // assuming a 2-week rental period
        $rental->save();

        return $rental;
    }

    public function returnBook($rentalId)
    {
        $rental = Rental::find($rentalId);
        if (!$rental) {
            return false;
        }

        $rental->returned_on = now();
        $rental->save();

        return true;
    }

    public function getRentalHistory()
    {
        return Rental::all();
    }
}