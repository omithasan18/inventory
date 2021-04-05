<?php

use Illuminate\Database\Seeder;

class WearhouseProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i < 50; $i++) { 
            DB::table('wearhouse_products')->insert([
                'product_id'=>$i,
                'wear_house_id'=>(int) rand(1, 10),
                'opening_quantity'=>(int) rand(30, 50),
                'quantity'=>(int) rand(70, 80),
                'available_quantity'=>(int) rand(90, 100),
                'total_quantity'=>(int) rand(140, 150),
                'ready_quantity'=>(int) rand(40, 50),
                'total_transfer'=>(int) rand(40, 50),
            ]);
        }
    }
}
