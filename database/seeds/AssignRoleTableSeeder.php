<?php

use Illuminate\Database\Seeder;

class AssignRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('assign_roles')->insert([
            'user_id'=>1,
            'role_id'=>1,
            'category'=>1,
            'brand'=>1,
            'add_product'=>1,
            'view_product'=>1,
            'edit_product'=>1,
            'user'=>1,
            'customer'=>1,
            'supplier'=>1,
            'pos'=>1,
            'setting'=>1,
            'wearhouse'=>1,
            'add_transfer'=>1,
            'distributed_transfer'=>1,
        ]);
        DB::table('assign_roles')->insert([
            'user_id'=>1,
            'role_id'=>3,
            'wearhouse'=>1,
        ]);
        DB::table('assign_roles')->insert([
            'user_id'=>1,
            'role_id'=>4,
            'pos'=>1,
        ]);
        
    }
}
