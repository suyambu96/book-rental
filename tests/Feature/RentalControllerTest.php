<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Book;
use App\Models\Rental;

class RentalControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_stores_new_rental_if_user_and_book_exist()
    {
        // Create user and book using factories
        $user = User::factory()->create();
        $book = Book::factory()->create();
        // Make API request to create a rental
        $response = $this->postJson('/api/rentals', [
            'user_id' => $user->id,
            'book_id' => $book->id
        ]);
        
        $response->assertStatus(201);
        $response->assertJsonStructure([
            'data' => [
                'user_id',
                'book_id',
                'rented_on',
                'due_date'
            ]
        ]);
    }

    /** @test */
    public function it_returns_error_if_user_or_book_does_not_exist()
    {
        $user = User::factory()->create();

        $response = $this->postJson('/api/rentals', [
            'user_id' => $user->id,
            'book_id' => 9999 // Non-existent book
        ]);

        // $response->assertStatus(201);
        $response->assertStatus(422); // Assuming your API returns 404 when a user or book doesn't exist
        $response->assertJson([
            'message' => 'The selected book id is invalid.',
            'errors' => [
                'book_id' => [
                    'The selected book id is invalid.'
                ]
            ]
        ]);
    }

    /** @test */
    public function it_allows_a_book_to_be_returned()
    {
        $rental = Rental::factory()->create();

        $response = $this->postJson('/api/rentals/' . $rental->id . '/return');

        $response->assertOk();
        $this->assertNotNull($rental->fresh()->returned_on);
    }

    /** @test */
    public function it_retrieves_rental_history_successfully()
    {
        Rental::factory()->count(5)->create();

        $response = $this->getJson('/api/rentals/history');

        $response->assertOk();
        $response->assertJsonStructure([
            '*' => ['user', 'book', 'rented_on', 'due_date', 'returned_on', 'overdue']
        ]);
    }
}