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
        Schema::create('supply', function (Blueprint $table) {
            $table->id('supply_id');
            // $table->integer('cart_id');
            $table->integer('med_id')->unique();
            $table->string('med_name');
            $table->integer('price_perUnit');
            $table->integer('stock');
            $table->date('expiryDate');
            $table->date('manufacturingDate');
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
        Schema::dropIfExists('supply');
    }
};
