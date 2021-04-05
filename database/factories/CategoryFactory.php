<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    static $i =1;
    return [
        'title' => $faker->name,
        'image' => 'https://i.picsum.photos/id/'.$i++.'/300/300.jpg',
        'status' =>1,
    ];
});
