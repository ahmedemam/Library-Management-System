<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Favourite;
use App\User;
use App\Book;
use Faker\Generator as Faker;

$factory->define(Favourite::class, function (Faker $faker) {
    return [
         'user_id' => factory(User::class)->create()->id,
          'book_id' => factory(Book::class)->create()->id
    ];
});
