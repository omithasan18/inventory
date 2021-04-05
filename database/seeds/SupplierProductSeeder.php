<?php

use Illuminate\Database\Seeder;

class SupplierProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i < 50; $i++) { 
            DB::table('supplier_products')->insert([
                'product_id'=>$i,
                'supplier_id'=>(int) rand(1, 10),
                'admin_id'=>1,
                'available_qty'=>(int) rand(30, 50),
                'quantity'=>(int) rand(70, 80),
                'total_available_qty'=>(int) rand(90, 100),
                'average_buying_price'=>(int) rand(400, 500),
                'buying_price'=>(int) rand(700, 800),
                'selling_price'=>(int) rand(700, 800),
                'total_buying_price'=>(int) rand(1700, 1800),
                'total_qty'=>(int) rand(60, 70),
                'total_qty_amount'=>(int) rand(1700, 1800),
                'total_sales'=>(int) rand(70, 80),
                'total_sales_amount'=>(int) rand(70, 80),
                'status'=>1,
            ]);
        }
    }
}
