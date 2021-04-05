<?php

use Illuminate\Database\Seeder;

class ColorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('colors')->insert([
            'color_name'=>"Blue",
            'status'=>1,
        ]);
        DB::table('colors')->insert([
            'color_name'=>"Green",
            'status'=>1,
        ]);
        DB::table('colors')->insert([
            'color_name'=>"White",
            'status'=>1,
        ]);
        DB::table('colors')->insert([
            'color_name'=>"Yello",
            'status'=>1,
        ]);
        DB::table('colors')->insert([
            'color_name'=>"Red",
            'status'=>1,
        ]);
    }
}
