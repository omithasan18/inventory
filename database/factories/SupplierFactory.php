<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Suplier;
use Faker\Generator as Faker;

$factory->define(Suplier::class, function (Faker $faker) {
    static $i =1;
    return [
        'supplier_name' => $faker->name,
        'business_name' => $faker->name,
        'pi_number' => (int) rand(200, 2000),
        'contact_code' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'phone' => $faker->randomNumber(),
        'city' => $faker->name,
        'image' => 'https://i.picsum.photos/id/'.$i++.'/300/300.jpg',
        'status' =>1,
    ];
});
