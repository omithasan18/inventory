<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistributedProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distributed_products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_id');
            $table->bigInteger('distributed_id');
            $table->bigInteger('color_id');
            $table->bigInteger('opening_quantity')->comment('total opening available quantity')->default(0);
            $table->bigInteger('quantity')->comment('current buying quantity')->default(0);
            $table->bigInteger('available_quantity')->comment('current available quantity')->default(0);
            $table->bigInteger('total_quantity')->comment('life time total quantity')->default(0);
            $table->bigInteger('total_sale')->nullable();
            $table->bigInteger('treturn_qty')->nullable()->comment('total return quantity')->default(0);
            $table->bigInteger('twasted_qty')->nullable()->comment('total wasted quantity')->default(0);
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('distributed_products');
    }
}
