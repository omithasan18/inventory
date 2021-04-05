<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use App\OrderDetails;
use Faker\Generator as Faker;

$factory->define(OrderDetails::class, function (Faker $faker) {
    return [
        'order_id' => (int) rand(1, 10),
        'product_id' => (int) rand(1, 10),
        'quantity' => (int) rand(1, 3),
        'unit_cost' => (int) rand(200, 300),
        'total' => (int) rand(2000, 3000),
    ];
});
