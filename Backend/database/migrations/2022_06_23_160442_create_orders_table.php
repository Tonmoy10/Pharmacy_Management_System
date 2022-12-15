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
        Schema::create('orders', function (Blueprint $table) {
            $table->id('order_id');
            $table->integer('cart_id');
            $table->integer('customer_id');
            $table->integer('totalbill');
            $table->string('order_status')->default('pending');
            $table->dateTime('accepted_time')->nullable();
            $table->dateTime('delivery_time')->nullable();
            $table->integer('delivery_charge')->default(15);
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
};
