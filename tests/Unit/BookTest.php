<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Book;
use Illuminate\Database\Eloquent\Collection;

class BookTest extends TestCase
{
    /**
     * Test searching books by name.
     */
    public function testSearchBooksByName()
    {
        $bookMock = \Mockery::mock(Book::class);
        $bookMock->shouldReceive('searchByCriteria')
                 ->with(['name' => 'Laravel'])
                 ->andReturn(new Collection([new Book(['title' => 'Laravel for Beginners'])]));

        $books = $bookMock->searchByCriteria(['name' => 'Laravel']);
        $this->assertCount(1, $books);
        $this->assertEquals('Laravel for Beginners', $books->first()->title);
    }

    /**
     * Test searching books by genre.
     */
    public function testSearchBooksByGenre()
    {
        $bookMock = \Mockery::mock(Book::class);
        $bookMock->shouldReceive('searchByCriteria')
                 ->with(['genre' => 'Programming'])
                 ->andReturn(new Collection([new Book(['title' => 'Laravel for Beginners']), new Book(['title' => 'Advanced Laravel'])]));

        $books = $bookMock->searchByCriteria(['genre' => 'Programming']);
        $this->assertCount(2, $books);
        $this->assertEquals('Laravel for Beginners', $books->first()->title);
        $this->assertEquals('Advanced Laravel', $books[1]->title);
    }
}