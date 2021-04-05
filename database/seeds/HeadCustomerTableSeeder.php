<?php

use Illuminate\Database\Seeder;

class HeadCustomerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('head_customers')->insert([
            'name'=>"Walk in Customer",
            'business_name'=>"Walk in Customer",
            'status'=>1,
        ]);
    }
}
