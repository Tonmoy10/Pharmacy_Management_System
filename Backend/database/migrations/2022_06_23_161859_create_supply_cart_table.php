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
        Schema::create('supply_cart', function (Blueprint $table) {
            $table->id('cart_id');
            $table->string('med_name');
            $table->integer('med_id');
            $table->integer('price_perUnit');
            $table->string('quantity');
            $table->integer('total_price');
            $table->integer('vendor_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('supply_cart');
    }
};
