<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Book;
use App\Models\Rental;

class StatsControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test for most overdue books.
     */
    public function testMostOverdueBooks()
    {
        // Setup: Create overdue and non-overdue rentals
        $overdueBook = Book::factory()->create();
        Rental::factory()->create([
            'book_id' => $overdueBook->id,
            'due_date' => now()->subDays(10),
            'returned_on' => null
        ]);

        $nonOverdueBook = Book::factory()->create();
        Rental::factory()->create([
            'book_id' => $nonOverdueBook->id,
            'due_date' => now()->addDays(10),
            'returned_on' => null
        ]);

        // Test
        $response = $this->getJson('/api/stats/most-overdue');
        $response->assertOk();
        $response->assertJsonCount(1); // Only one overdue book
        $response->assertJsonFragment([
            'book_id' => $overdueBook->id
        ]);
    }

    /**
     * Test for the most popular book.
     */
    public function testMostPopularBook()
    {
        $popularBook = Book::factory()->create();
        Rental::factory()->count(5)->create(['book_id' => $popularBook->id]);

        $lessPopularBook = Book::factory()->create();
        Rental::factory()->count(3)->create(['book_id' => $lessPopularBook->id]);

        // Test
        $response = $this->getJson('/api/stats/most-popular');
        $response->assertOk();
        $response->assertJson([
            'book_id' => $popularBook->id,
            'total' => 5
        ]);
    }

    /**
     * Test for the least popular book.
     */
    public function testLeastPopularBook()
    {
        $popularBook = Book::factory()->create();
        Rental::factory()->count(5)->create(['book_id' => $popularBook->id]);

        $lessPopularBook = Book::factory()->create();
        Rental::factory()->count(3)->create(['book_id' => $lessPopularBook->id]);

        // Test
        $response = $this->getJson('/api/stats/least-popular');
        $response->assertOk();
        $response->assertJson([
            'book_id' => $lessPopularBook->id,
            'total' => 3
        ]);
    }
}