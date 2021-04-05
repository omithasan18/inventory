<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductStockHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_stock_histories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('admin_id');
            $table->bigInteger('product_id');
            $table->bigInteger('color_id');
            $table->bigInteger('supplier_id')->nullable();
            $table->float('purchase_price',20,2)->nullable()->comment('Product Purchase Price');
            $table->string('total_cost')->nullable();
            $table->bigInteger('opening_quantity')->comment('total opening available quantity')->default(0);
            $table->bigInteger('quantity')->comment('current buying quantity')->default(0);
            $table->bigInteger('available_quantity')->comment('current available quantity')->default(0);
            $table->bigInteger('total_quantity')->comment('life time total quantity')->default(0);
            $table->bigInteger('total_transfer')->comment('life time total transfer')->default(0);;
            $table->bigInteger('treturn_qty')->nullable()->comment('total return quantity')->default(0);
            $table->bigInteger('twasted_qty')->nullable()->comment('total wasted quantity')->default(0);
            $table->float('cost_per_qty',20,2)->nullable();
            $table->float('total_buying_cost_per_qty',20,2)->nullable();
            $table->float('total_buying_cost',20,2)->nullable();
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
        Schema::dropIfExists('product_stock_histories');
    }
}
