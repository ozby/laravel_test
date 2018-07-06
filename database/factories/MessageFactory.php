<?php

use Faker\Generator as Faker;

$factory->define(\App\Message::class, function (Faker $faker) {
    return [
        '_id' => $faker->unique()->randomNumber(),
        'sender' => $faker->name,
        'subject' => $faker->text,
        'message' => $faker->text,
    ];
});
