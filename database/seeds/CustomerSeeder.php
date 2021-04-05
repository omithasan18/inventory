<?php

use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customers')->insert([
            'parent_id'=>1,
            'customer_name'=>"Walk in Customer",
            'status'=>1,
        ]);
    }
}
