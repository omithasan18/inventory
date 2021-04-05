<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('admin_id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('slug')->nullable();
            $table->integer('category_id')->nullable();
            $table->integer('brand_id')->nullable();
            $table->integer('supplier_id')->nullable();
            $table->text('image')->nullable();
            $table->string('supplier_code');
            $table->string('product_code')->nullable();
            $table->string('product_unit');
            $table->bigInteger('gp')->nullable()->default(0)->comment('Should be percentage');
            $table->float('purchase_price',20,2)->nullable()->comment('Product Purchase Price');
            $table->float('selling_price',10,2)->comment('Product Selling Price')->nullable();
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
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('products');
    }
}
