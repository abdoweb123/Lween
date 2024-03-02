<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->boolean('status')->default(1);
            $table->boolean('new_arrival')->default(0);
            $table->boolean('most_selling')->default(0);
            $table->boolean('featured')->default(0);
            $table->string('title_ar')->nullable();
            $table->string('title_en')->nullable();
            $table->longText('short_desc_ar')->nullable();
            $table->longText('short_desc_en')->nullable();
            $table->longText('long_desc_ar')->nullable();
            $table->longText('long_desc_en')->nullable();
            $table->string('header')->nullable();
            $table->decimal('price', 8, 3)->default(0.000);
            $table->integer('quantity')->default(0);
            $table->integer('discount_value')->default(0);
            $table->timestamp('discount_from')->nullable();
            $table->timestamp('discount_to')->nullable();
            $table->timestamps();
            
            $table->foreign('brand_id', 'devices_brand_id_foreign')->references('id')->on('brands')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('devices');
    }
}
