<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Book;
use App\Comment;
use App\User;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'rate' => $faker->numberBetween(0, 5),
        'review' => $faker->text(),
        'user_id' => function () {
            return User::all()->random();
        },
        'book_id' => function () {
            return Book::all()->random();
        },
    ];
});
