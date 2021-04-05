<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assign_roles', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('role_id');
            $table->string('category')->nullable();
            $table->string('view_category')->nullable();
            $table->string('add_category')->nullable();
            $table->string('edit_category')->nullable();
            $table->string('delete_category')->nullable();
            $table->string('brand')->nullable();
            $table->string('view_brand')->nullable();
            $table->string('add_brand')->nullable();
            $table->string('edit_brand')->nullable();
            $table->string('delete_brand')->nullable();
            $table->string('product')->nullable();
            $table->string('view_product')->nullable();
            $table->string('add_product')->nullable();
            $table->string('edit_product')->nullable();
            $table->string('delete_product')->nullable();
            $table->string('user')->nullable();
            $table->string('view_user')->nullable();
            $table->string('add_user')->nullable();
            $table->string('edit_user')->nullable();
            $table->string('delete_user')->nullable();
            $table->string('customer')->nullable();
            $table->string('view_customer')->nullable();
            $table->string('edit_customer')->nullable();
            $table->string('delete_customer')->nullable();
            $table->string('supplier')->nullable();
            $table->string('view_supplier')->nullable();
            $table->string('add_supplier')->nullable();
            $table->string('edit_supplier')->nullable();
            $table->string('delete_supplier')->nullable();
            $table->string('pos')->nullable();
            $table->string('view_pos')->nullable();
            $table->string('add_pos')->nullable();
            $table->string('setting')->nullable();
            $table->string('view_setting')->nullable();
            $table->string('add_setting')->nullable();
            $table->string('edit_setting')->nullable();
            $table->string('delete_setting')->nullable();
            $table->string('wearhouse')->nullable();
            $table->string('view_wearhouse')->nullable();
            $table->string('add_transfer')->nullable();
            $table->string('distributed_transfer')->nullable();
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
        Schema::dropIfExists('assign_roles');
    }
}
