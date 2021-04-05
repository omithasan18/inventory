<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Distributed;
use Faker\Generator as Faker;

$factory->define(Distributed::class, function (Faker $faker) {
    return [
        'distributed_name' => $faker->name,
        'location' => $faker->name,
        'role_id' => 4,
        'phone' => $faker->randomNumber(),
        'status' =>1,
    ];
});
