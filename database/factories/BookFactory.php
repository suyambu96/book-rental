<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Book::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence($nbWords = 3, $variableNbWords = true),  // Generates a random title
            'author' => $this->faker->name,                                          // Generates a random author name
            'isbn' => $this->faker->isbn13,                                          // Generates a random ISBN-13
            'genre' => $this->faker->word                                            // Generates a random word for genre
        ];
    }
}