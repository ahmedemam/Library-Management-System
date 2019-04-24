<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Category;
use App\User;
use Faker\Generator as Faker;

$factory->define(App\Book::class, function (Faker $faker) {
    return [
        'title' => $faker->unique()->title,
        'description' => $faker->text,
        'author' => $faker->name,
        'image' => $faker->image('/temp', 200, 300, 'people', true, true, 'Faker'),
        'copiesNumber' => $faker->randomDigit,
        'leaseFee' => $faker->randomDigit,
        'rate' => 0,
        'category_id' => function () {
            return Category::all()->random();
        }
    ];
});

