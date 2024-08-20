<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_search_books_by_name()
    {
        Book::create([
            'title' => 'Laravel for Beginners',
            'author' => 'John Doe',
            'isbn' => '1234567890',
            'genre' => 'Programming'
        ]);
        Book::create([
            'title' => 'Advanced Laravel',
            'author' => 'Jane Doe',
            'isbn' => '0987654321',
            'genre' => 'Programming'
        ]);

        $response = $this->get('/api/books?name=Laravel');

        $response->assertStatus(200);
        $response->assertJsonCount(2);
        $response->assertJsonFragment(['title' => 'Laravel for Beginners']);
        $response->assertJsonFragment(['title' => 'Advanced Laravel']);
    }

    public function test_search_books_by_genre()
    {
        Book::create([
            'title' => 'Laravel for Beginners',
            'author' => 'John Doe',
            'isbn' => '1234567890',
            'genre' => 'Programming'
        ]);
        Book::create([
            'title' => 'Advanced Laravel',
            'author' => 'Jane Doe',
            'isbn' => '0987654321',
            'genre' => 'Programming'
        ]);
        Book::create([
            'title' => 'Some Novel',
            'author' => 'Author Name',
            'isbn' => '1122334455',
            'genre' => 'Novel'
        ]);

        $response = $this->get('/api/books?genre=Programming');

        $response->assertStatus(200);
        $response->assertJsonCount(2);
        $response->assertJsonFragment(['title' => 'Laravel for Beginners']);
        $response->assertJsonFragment(['title' => 'Advanced Laravel']);
    }

    public function test_search_books_by_name_and_genre()
    {
        Book::create([
            'title' => 'Laravel for Beginners',
            'author' => 'John Doe',
            'isbn' => '1234567890',
            'genre' => 'Programming'
        ]);
        Book::create([
            'title' => 'Advanced Laravel',
            'author' => 'Jane Doe',
            'isbn' => '0987654321',
            'genre' => 'Programming'
        ]);
        Book::create([
            'title' => 'Some Novel',
            'author' => 'Author Name',
            'isbn' => '1122334455',
            'genre' => 'Novel'
        ]);

        $response = $this->get('/api/books?name=Laravel&genre=Programming');

        $response->assertStatus(200);
        $response->assertJsonCount(2);
        $response->assertJsonFragment(['title' => 'Laravel for Beginners']);
    }
}