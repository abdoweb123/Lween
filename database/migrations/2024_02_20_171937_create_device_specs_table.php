<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeviceSpecsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('device_specs', function (Blueprint $table) {
            $table->id();
            $table->boolean('status')->default(1);
            $table->unsignedBigInteger('device_id');
            $table->unsignedBigInteger('specs_id');
            $table->longText('desc_ar')->nullable();
            $table->longText('desc_en')->nullable();
            $table->timestamps();
            
            $table->foreign('device_id', 'device_specs_device_id_foreign')->references('id')->on('devices')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('specs_id', 'device_specs_specs_id_foreign')->references('id')->on('specs')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('device_specs');
    }
}
