<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(AssignRoleTableSeeder::class);
        // $this->call(HeadCustomerTableSeeder::class);
        // $this->call(CustomerSeeder::class);
        // $this->call(DistributedProductSeeder::class);
        // $this->call(StockHistorySeeder::class);
        // $this->call(SupplierProductSeeder::class);
        // $this->call(WearhouseProductSeeder::class);
        $this->call(ColorTableSeeder::class);
        $this->call(ShopSeeder::class);
        factory(App\Category::class, 10)->create();
        factory(App\Head_customer::class, 10)->create();
        factory(App\Customer::class, 10)->create();
        factory(App\Brand::class, 10)->create();
        factory(App\Suplier::class, 10)->create();
        // factory(App\Product::class, 50)->create();
        factory(App\Wear_house::class, 10)->create();
        factory(App\Distributed::class, 10)->create();
        // factory(App\Order::class, 10)->create();
        // factory(App\OrderDetails::class, 30)->create();
    }
}
