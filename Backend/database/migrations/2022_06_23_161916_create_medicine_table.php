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
        Schema::create('medicine', function (Blueprint $table) {
            $table->id('med_id');
            $table->string('med_name');
            $table->integer('price_perUnit');
            $table->integer('Stock');
            $table->date('manufacturingDate');
            $table->date('expiryDate');
            $table->integer('vendor_id');
            $table->string('vendor_name');
            $table->integer('contract_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medicine');
    }
};
