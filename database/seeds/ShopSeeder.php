<?php

use Illuminate\Database\Seeder;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shop_addresses')->insert([
            'name'=>"ProClean",
            'email'=>"procleanbd@gmail.com",
            'phone'=>"+8801741-426269",
            'address1'=>"Flat A2, Rupkotha House 198/200 Road 2, DOHS,",
            'address2'=>"DHAKA-1216, Bangladesh.",
            'website_url'=>"www.procleanbd.com",
        ]);
    }
}
