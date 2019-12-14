<?php

use Illuminate\Database\Seeder;

class AuthorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // creating authors using AuthorFactory
        factory(\App\Models\Author::class, 10)->create();
    }
}
