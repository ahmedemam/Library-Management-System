<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(BooksTableSeeder::class);
        $this->call(FavouritesTableSeeder::class);
        $this->call(CommentsTableSeeder::class);
        $this->call(LeasedBooksTableSeeder::class);
    }
}
