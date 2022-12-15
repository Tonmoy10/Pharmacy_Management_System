<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders_cart', function (Blueprint $table) {
            $table->id('id');
            $table->integer('order_id');
            $table->integer('cart_id');
            $table->string('items');
            $table->integer('quantity');
            $table->integer('med_id');
            $table->string('return_status')->default('false');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders_cart');
    }
};
