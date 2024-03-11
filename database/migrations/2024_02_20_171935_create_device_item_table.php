<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeviceItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('device_item', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('device_id');
            $table->unsignedBigInteger('color_id')->nullable();
            $table->unsignedBigInteger('os')->nullable();
            $table->unsignedBigInteger('size_id')->nullable();
            $table->unsignedBigInteger('processor_id')->nullable();
            $table->unsignedBigInteger('memory_id')->nullable();
            $table->unsignedBigInteger('storage_id')->nullable();
            $table->decimal('price', 8, 3)->default(0.000);
            $table->integer('quantity')->default(0);
            $table->timestamps();
            
            $table->foreign('color_id', 'device_item_color_id_foreign')->references('id')->on('colors')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('device_id', 'device_item_device_id_foreign')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('memory_id', 'device_item_memory_id_foreign')->references('id')->on('memories')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('os', 'device_item_os_foreign')->references('id')->on('os')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('processor_id', 'device_item_processor_id_foreign')->references('id')->on('processors')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('size_id', 'device_item_size_id_foreign')->references('id')->on('sizes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('storage_id', 'device_item_storage_id_foreign')->references('id')->on('storages')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('device_item');
    }
}
