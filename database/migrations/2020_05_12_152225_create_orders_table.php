<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('customer_id');
            $table->bigInteger('head_customer_id')->nullable();
            $table->bigInteger('seller_id')->nullable();
            $table->string('pio_number')->nullable();
            $table->string('pio_date')->nullable();
            $table->string('order_date')->nullable();
            $table->string('invoice_date')->nullable();
            $table->string('invoice_number')->nullable();
            $table->string('delivery_date')->nullable();
            $table->string('discount_type')->nullable();
            $table->string('month')->nullable();
            $table->string('year')->nullable();
            $table->integer('order_status')->nullable();
            $table->string('total_products')->nullable()->comment('Total order quantity');
            $table->float('sub_total',20,2)->default(0);
            $table->float('vat',10,2)->default(0);
            $table->float('shipping',10,2)->default(0);
            $table->float('discount',10,2)->default(0)->comment('discount/gp %');
            $table->float('discount_amount',10,2)->nullable()->comment('discount amount');
            $table->float('total',20,2);
            $table->string('payment_status')->nullable();
            $table->float('pay',10,2)->nullable();
            $table->float('due',10,2)->nullable();
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
        Schema::dropIfExists('orders');
    }
}
