<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Head_customer;
use Faker\Generator as Faker;

$factory->define(Head_customer::class, function (Faker $faker) {
    static $i =1;
    return [
        'name' => $faker->name,
        'business_name' => $faker->name,
        'phone' => 017777777,
        'email' => $faker->unique()->safeEmail,
        'address' => 'Dhaka,Bangladesh',
        'image' => 'https://i.picsum.photos/id/'.$i++.'/300/300.jpg',
        'status' =>1,
    ];
});
