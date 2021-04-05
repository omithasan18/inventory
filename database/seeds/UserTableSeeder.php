<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'=>"admin",
            'email'=>'admin@admin.com',
            'phone'=>'1052454',
            'password' => bcrypt('123123123'),
            'role_id'=>1,
            'status'=>1
        ]);
        DB::table('users')->insert([
            'name'=>"sub_admin",
            'email'=>'sub_admin@admin.com',
            'phone'=>'1052454',
            'password' => bcrypt('123123123'),
            'role_id'=>2,
            'status'=>1
        ]);
    }
}
