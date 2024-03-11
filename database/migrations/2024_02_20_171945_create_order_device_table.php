<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDeviceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_device', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id')->nullable();
            $table->unsignedBigInteger('device_id')->nullable();
            $table->unsignedBigInteger('color_id')->nullable();
            $table->decimal('price', 8, 3)->nullable();
            $table->smallInteger('quantity');
            $table->decimal('total', 9, 3)->nullable();
            $table->timestamps();
            
            $table->foreign('color_id', 'order_device_color_id_foreign')->references('id')->on('colors')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('device_id', 'order_device_device_id_foreign')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('order_id', 'order_device_order_id_foreign')->references('id')->on('orders')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_device');
    }
}
