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
        Schema::create('accepted_order', function (Blueprint $table) {
            $table->id('id');
            $table->integer('order_id');
            $table->string('courier_name');
            $table->string('order_status');
            $table->dateTime('accepted_time');
            $table->dateTime('delivery_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accepted_order');
    }
};
