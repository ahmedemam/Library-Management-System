<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
         'user_id' => factory('App\User')->create()->id,
          'book_id' => factory('App\Book')->create()->id
    ];
});