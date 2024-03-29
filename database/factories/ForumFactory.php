<?php

use Faker\Generator as Faker;

$factory->define(App\Forum::class, function (Faker $faker) {
    $name = $faker->name;
    return [
        'name' => $name,
        'slug' => str_slug($name, '-'),
        'description' => $faker->paragraph,
    ];
});
