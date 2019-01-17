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
        // $this->call(UsersTableSeeder::class);
        factory(\App\Forum::class, 20)->create();
        factory(\App\User::class, 50)->create();
        factory(\App\Post::class, 100)->create();
        factory(\App\Reply::class, 100)->create();
    }
}
