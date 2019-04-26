<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Category;
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
        'user_id' => function () {
            return User::all()->random();
        },
        'book_id' => function () {
            return Book::all()->random();
        }
    ];
});
