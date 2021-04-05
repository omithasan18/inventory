<?php

use Illuminate\Database\Seeder;

class StockHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i < 50; $i++) { 
            DB::table('stock_histories')->insert([
                'product_id'=>$i,
                'admin_id'=>1,
                'opening_quantity'=>(int) rand(30, 50),
                'quantity'=>(int) rand(70, 80),
                'available_quantity'=>(int) rand(90, 100),
                'total_quantity'=>(int) rand(140, 150),
                'total_sale'=>(int) rand(40, 50),
            ]);
        }
    }
}
