<?php

use Illuminate\Database\Seeder;

class BookReviewTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // getting all users
        $users = \App\User::all();

        // getting all books
        $books = \App\Models\Book::all();

        // creating bookReviews using BookReviewFactory
        $books->each(function (\App\Models\Book $book) use ($users) {

            // getting bookReviews that has not been saved yet in DB
            $book_reviews = factory(\App\Models\BookReview::class, 3)->make();

            $book_reviews->each(function (\App\Models\BookReview $bookReview) use ($users) {

                $bookReview->user()->associate($users->random());

            });

            $book->reviews()->saveMany($book_reviews);

        });


    }
}
