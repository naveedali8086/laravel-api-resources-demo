<?php

use Illuminate\Database\Seeder;

class BookAuthorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // getting all authors
        $authors = \App\Models\Author::all();

        // getting all books
        $books = \App\Models\Book::all();

        // populating book_author table
        $books->each(function (\App\Models\Book $book) use ($authors) {

            $book->authors()->saveMany($authors);

        });
    }
}
