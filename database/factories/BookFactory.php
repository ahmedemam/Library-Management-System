<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Book;
use App\Category;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
    return [
        'title' => $faker->unique()->name,
        'description' => $faker->text,
        'author' => $faker->name,
        'image' => $faker->imageUrl(200, 300, 'abstract', false, false, 'Faker'),
        'copiesNumber' => $faker->randomDigit,
        'leaseFee' => $faker->randomDigit,
        'rate' => 0,
        'category_id' => function () {
            return Category::all()->random();
        },
    ];
});
