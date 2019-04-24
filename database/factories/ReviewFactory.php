<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Review;
use Illuminate\Support\Str;
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

$factory->define(App\Review::class, function (Faker $faker) {
    return [
        'rate' => $faker->numberBetween($min = 1, $max = 95),
        'review' => $faker->text(),
        'userId' => factory('App\User')->create()->id,
        'bookId' => factory('App\Book')->create()->id,
    ];
});
