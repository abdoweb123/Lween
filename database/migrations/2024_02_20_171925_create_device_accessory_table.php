<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeviceAccessoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('device_accessory', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('accessory_id');
            $table->unsignedBigInteger('device_id');
            $table->timestamps();
            
            $table->foreign('accessory_id', 'device_accessory_accessory_id_foreign')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('device_id', 'device_accessory_device_id_foreign')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('device_accessory');
    }
}
