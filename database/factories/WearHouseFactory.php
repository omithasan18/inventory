<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Wear_house;
use Faker\Generator as Faker;

$factory->define(Wear_house::class, function (Faker $faker) {
    return [
        'wear_house_name' => $faker->name,
        'location' => $faker->name,
        'role_id' => 1,
        'phone' => $faker->randomNumber(),
        'status' =>1,
    ];
});
