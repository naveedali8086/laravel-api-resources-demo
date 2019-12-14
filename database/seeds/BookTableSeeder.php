<?php

use Illuminate\Database\Seeder;

class BookTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // creating books using BookFactory
        factory(\App\Models\Book::class, 5)->create();

    }
}
