<?php

use Illuminate\Database\Seeder;

class FavouriteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            factory('App\Favourite', 200)->create();

    }
}