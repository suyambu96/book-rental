<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Book;
use App\Models\Rental;
use App\Services\RentalService;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RentalServiceTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateRentalSuccessfully()
    {
        $user = User::factory()->create();
        $book = Book::factory()->create();
        $rentalService = new RentalService();

        $rental = $rentalService->createRental($user->id, $book->id);

        $this->assertInstanceOf(Rental::class, $rental);
        $this->assertEquals($user->id, $rental->user_id);
        $this->assertEquals($book->id, $rental->book_id);
    }

    public function testReturnBookSuccessfully()
    {
        $rental = Rental::factory()->create(['returned_on' => null]);
        $rentalService = new RentalService();

        $success = $rentalService->returnBook($rental->id);

        $this->assertTrue($success);
        $this->assertNotNull($rental->fresh()->returned_on);
    }

    public function testGetRentalHistory()
    {
        Rental::factory()->count(5)->create();
        $rentalService = new RentalService();

        $history = $rentalService->getRentalHistory();

        $this->assertCount(5, $history);
    }
}