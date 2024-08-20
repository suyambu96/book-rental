<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Book;
use App\Models\Rental;
use App\Services\StatsService;
use Mockery;
use Illuminate\Support\Collection;
use App\Repositories\BookRepository;


class StatsServiceTest extends TestCase
{
    public function testMostOverdueBooks()
    {
        $mockRepo = Mockery::mock(BookRepository::class);
        $statsService = new StatsService($mockRepo);
        
        $mockRepo->shouldReceive('getMostOverdueBooks')->once()->andReturn('expected results');

        $result = $statsService->getMostOverdueBooks();
        $this->assertEquals('expected results', $result);
    }
    public function testMostPopularBook()
    {
        // Create a mock of BookRepository
        $mockRepo = Mockery::mock(BookRepository::class);
        
        // Create an instance of StatsService with the mock
        $statsService = new StatsService($mockRepo);

        // Define expectation on the mock
        $mockRepo->shouldReceive('getMostPopularBook')
                 ->once() // Ensures this method is called exactly once
                 ->andReturn('expected result'); // Mock the return value

        // Call the method under test
        $result = $statsService->getMostPopularBook();

        // Assert the expected result
        $this->assertEquals('expected result', $result);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        Mockery::close(); // Properly close Mockery to avoid memory leaks
    }
    public function testLeastPopularBook()
    {
        // Create a mock of BookRepository
        $mockRepo = Mockery::mock(BookRepository::class);
        
        // Create an instance of StatsService with the mock
        $statsService = new StatsService($mockRepo);

        // Define the method expectation on the mock
        $mockRepo->shouldReceive('getLeastPopularBook')
                 ->once() // Ensures this method is called exactly once
                 ->andReturn('expected result'); // Mock the return value

        // Call the method under test
        $result = $statsService->getLeastPopularBook();

        // Assert that the service returned the expected result
        $this->assertEquals('expected result', $result);
    }

}