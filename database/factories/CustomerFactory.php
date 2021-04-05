<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Customer;
use Faker\Generator as Faker;

$factory->define(Customer::class, function (Faker $faker) {
    static $i =1;
    return [
        'parent_id' => (int) rand(1, 10),
        'customer_name' => $faker->name,
        'contact_code' => $faker->name,
        'address' => $faker->sentence(),
        'email' => $faker->unique()->safeEmail,
        'phone' => $faker->randomNumber(),
        'image' => 'https://i.picsum.photos/id/'.$i++.'/300/300.jpg',
        'status' =>1,
    ];
});
