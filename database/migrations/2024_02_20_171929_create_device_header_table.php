<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeviceHeaderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('device_header', function (Blueprint $table) {
            $table->id();
            $table->string('header')->nullable();
            $table->boolean('status')->default(1);
            $table->unsignedBigInteger('device_id');
            $table->unsignedBigInteger('color_id')->nullable();
            $table->timestamps();
            
            $table->foreign('color_id', 'device_header_color_id_foreign')->references('id')->on('colors')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('device_id', 'device_header_device_id_foreign')->references('id')->on('devices')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('device_header');
    }
}
