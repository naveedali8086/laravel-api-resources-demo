<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\BookReview;
use Faker\Generator as Faker;

$factory->define(BookReview::class, function (Faker $faker) {
    return [
        'comments' => $faker->text,
        'review' => $faker->randomNumber(range(1, 5)),
    ];
});