<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    static $i =1;
    return [
        'admin_id' => (int) rand(1, 2),
        'title' => $faker->name,
        'slug' => Str::slug($faker->name, '-'),
        'category_id' => (int) rand(1, 10),
        'supplier_id' => (int) rand(1, 10),
        'brand_id' => (int) rand(1, 10),
        'supplier_code' => '#proclean'.$faker->name,
        'product_code' => (int) rand(200, 2000),
        'gp' => (int) rand(10, 20),
        'product_unit' => 'piece',
        'purchase_price' => (int) rand(200, 2000),
        'selling_price' =>(int) rand(250, 3000),
        'total_cost' =>(int) rand(250, 3000),
        'opening_quantity'=>0,
        'quantity' => (int) rand(1, 100),
        'available_quantity' => (int) rand(1, 100),
        'total_quantity' => (int) rand(1, 100),
        'total_transfer' => 0,
        'total_buying_cost_per_qty' => (int) rand(200, 2000),
        'total_buying_cost' =>(int) rand(250, 3000),
        'description' =>$faker-> paragraph,
        'image' => 'https://i.picsum.photos/id/'.$i++.'/300/300.jpg',
        'status' =>(int) rand(0, 1),
    ];

});
