<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupplierProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('admin_id');
            $table->unsignedBigInteger('supplier_id');
            $table->float('available_qty',10,2)->nullable()->comment('opening_stock_quantity');
            $table->float('quantity',10,2)->nullable()->comment('stock_in_quantity');
            $table->float('total_available_qty',10,2)->nullable()->comment('total_available_quantity');
            $table->float('average_buying_price',10,2)->nullable()->comment('average_buying_price');
            $table->float('buying_price',10,2)->nullable()->comment('current_buying_price');
            $table->float('selling_price',10,2)->nullable()->comment('current_selling_price');
            $table->float('total_buying_price',10,2)->nullable()->comment('total_available_quantity_buying_price');
            $table->float('total_qty',10,2)->nullable();
            $table->float('total_qty_amount',10,2)->nullable();
            $table->float('total_sales',10,2)->default(0);
            $table->float('total_sales_amount',10,2)->default(0);
            $table->string('date')->nullable();
            $table->tinyInteger('status');
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
        Schema::dropIfExists('supplier_products');
    }
}
