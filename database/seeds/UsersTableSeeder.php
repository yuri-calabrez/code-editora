<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\User::class, 1)->create([
            'name' => 'Yuri',
            'email' => 'yuri.calabrez@gmail.com',
            'password' => bcrypt('123456')
        ]);

        factory(\App\User::class, 9)->create();
    }
}
