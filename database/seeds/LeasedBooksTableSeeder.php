<?php

use App\LeasedBook;
use Illuminate\Database\Seeder;

class LeasedBooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(LeasedBook::class, 100)->create();
    }
}