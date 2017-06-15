<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Artisan::call('codeeduuser:make-permission');
        $this->call(UsersTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(BooksTableSeeder::class);
        $this->call(\CodeEduBook\Database\Seeders\AclSeeder::class);
        $this->call(\CodeEduBook\Database\Seeders\ChaptersTableSeeder::class);
    }
}
