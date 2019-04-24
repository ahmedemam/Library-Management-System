<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Category;
use App\Favourite;
use App\User;
use App\Book;
use Faker\Generator as Faker;

$factory->define(Favourite::class, function (Faker $faker) {
    return [
         'user_id' => function () {
             return User::all()->random();
         },
          'book_id' => function () {
              return Book::all()->random();
          }
    ];
});
