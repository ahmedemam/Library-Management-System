<?php

use App\Favourite;
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
        factory(Favourite::class, 200)->create();
    }
}
