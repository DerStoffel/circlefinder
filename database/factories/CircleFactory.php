<?php

use Faker\Generator as Faker;

$factory->define(\App\Circle::class, function (Faker $faker) {
    return [
        'user_id' => \App\User::inRandomOrder()->get()->first(),
        'type' => $faker->randomElement(['f2f', 'virtual', 'both']),
        'title' =>  $faker->catchPhrase,
        'completed' => false,
        'limit' => 5
    ];
});
