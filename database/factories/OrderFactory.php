<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'customer_id' => (int) rand(1, 10),
        'head_customer_id' => (int) rand(1, 10),
        'order_date' => "20-2-2020",
        'order_status' => (int) rand(1, 3),
        'total_products' => (int) rand(20, 30),
        'sub_total' => (int) rand(2000, 3000),
        'vat' => (int) rand(500, 600),
        'total' => (int) rand(3000, 3200),
        'payment_status' => "Cash",
        'pay' => (int) rand(1500, 2000),
        'due' => (int) rand(1000, 1200),
    ];
});
