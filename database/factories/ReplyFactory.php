<?php

use Faker\Generator as Faker;

$factory->define(App\Reply::class, function (Faker $faker) {
    return [
        'user_id' => \App\User::all()->random()->id,
        'post_id' => \App\Post::all()->random()->id,
        'reply' => $faker->paragraph,
        'attachment' => \Faker\Provider\Image::image(storage_path() . '\app\replies', 200, 200, 'animals', false),
    ];
});
