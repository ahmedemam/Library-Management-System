<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Review;
use App\User;
use App\Book;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Review::class, function (Faker $faker) {
    return [
        'rate' => $faker->numberBetween($min = 1, $max = 95),
        'review' => $faker->text(),
        'userId' => factory(User::class)->create()->id,
        'bookId' => factory(Book::class)->create()->id,
    ];
});
