<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Book;
use App\LeasedBook;
use App\User;
use Faker\Generator as Faker;

$factory->define(LeasedBook::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return User::all()->random();
        },
        'book_id' => function () {
            return Book::all()->random();
        },
    ];
});