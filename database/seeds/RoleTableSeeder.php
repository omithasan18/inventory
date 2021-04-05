<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'role_name'=>"Admin",
            'status'=>1,
        ]);
        DB::table('roles')->insert([
            'role_name'=>"Sub Admin",
            'status'=>1,
        ]);
        DB::table('roles')->insert([
            'role_name'=>"Wear House",
            'status'=>1,
        ]);
        DB::table('roles')->insert([
            'role_name'=>"Distributed",
            'status'=>1,
        ]);
    }
}
