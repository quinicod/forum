<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    $title = $faker->sentence;
    return [
        'user_id' => \App\User::all()->random()->id,
        'forum_id' => \App\Forum::all()->random()->id,
        'title' => $title,
        'slug' => str_slug($title, '-'),
        'description' => $faker->paragraph,
        // Los argumentos son: 
        // 1: Ruta -> Concatenamos la ruta de Storage con la ruta interna que crearemos 
        // 2: Ancho
        // 3: Alto 
        // 4: Categoría de la imagen 
        // 5: Si queremos guardar la Ruta Completa o sólo el nombre y la extensión del archivo 
        'attachment' => \Faker\Provider\Image::image(storage_path() . '\app\posts', 200, 200, 'technics', False),
    ];
});
