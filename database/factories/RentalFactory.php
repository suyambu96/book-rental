<?php

namespace Database\Factories;

use App\Models\Rental;
use App\Models\User;
use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

class RentalFactory extends Factory
{
    protected $model = Rental::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'book_id' => Book::factory(),
            'rented_on' => now(),
            'due_date' => now()->addDays(15),
            'returned_on' => null,
            'overdue' => false,
        ];
    }
}