<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevicesTable extends Migration
{
    public function up()
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('brand_id');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade')->onUpdate('cascade');
            
            $table->boolean('status')->default(1);

            $table->boolean('new_arrival')->default(0);
            $table->boolean('most_selling')->default(0);
            $table->boolean('most_popular')->default(0);
            $table->boolean('featured')->default(0);

            $table->string('title_ar')->nullable();
            $table->string('title_en')->nullable();

            $table->longText('short_desc_ar')->nullable();
            $table->longText('short_desc_en')->nullable();

            $table->longText('long_desc_ar')->nullable();
            $table->longText('long_desc_en')->nullable();

            $table->string('header')->nullable();

            $table->decimal('price', 8, 3)->nullable()->default(0.000);
            
            $table->integer('quantity')->nullable()->default(0);
            $table->integer('original_quantity')->nullable()->default(0);

            $table->integer('discount_value')->nullable()->default(0);
            $table->timestamp('discount_from')->nullable();
            $table->timestamp('discount_to')->nullable();

            $table->timestamps();
        });

        Schema::create('device_item', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('device_id');
            $table->foreign('device_id')->references('id')->on('devices')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('color_id')->nullable();
            $table->foreign('color_id')->nullable()->references('id')->on('colors')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('os')->nullable();
            $table->foreign('os')->nullable()->references('id')->on('os')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('size_id')->nullable();
            $table->foreign('size_id')->nullable()->references('id')->on('sizes')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('processor_id')->nullable();
            $table->foreign('processor_id')->nullable()->references('id')->on('processors')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('memory_id')->nullable();
            $table->foreign('memory_id')->nullable()->references('id')->on('memories')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('storage_id')->nullable();
            $table->foreign('storage_id')->nullable()->references('id')->on('storages')->onDelete('cascade')->onUpdate('cascade');


            $table->decimal('price', 8, 3)->nullable()->default(0.000);
            $table->integer('quantity')->nullable()->default(0);
            
            $table->timestamps();
        });

        Schema::create('device_category', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('device_id');
            $table->foreign('device_id')->references('id')->on('devices')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
        });

        Schema::create('device_accessory', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('accessory_id');
            $table->foreign('accessory_id')->references('id')->on('devices')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('device_id');
            $table->foreign('device_id')->references('id')->on('devices')->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
        });

        Schema::create('device_gallery', function (Blueprint $table) {
            $table->id();

            $table->string('image')->nullable();

            $table->boolean('status')->default(1);

            $table->unsignedBigInteger('device_id');
            $table->foreign('device_id')->references('id')->on('devices')->onDelete('cascade')->onUpdate('cascade');


            $table->unsignedBigInteger('color_id')->nullable();
            $table->foreign('color_id')->nullable()->references('id')->on('colors')->onDelete('cascade')->onUpdate('cascade');


            $table->timestamps();
        });
        
        Schema::create('device_header', function (Blueprint $table) {
            $table->id();

            $table->string('header')->nullable();

            $table->boolean('status')->default(1);

            $table->unsignedBigInteger('device_id');
            $table->foreign('device_id')->references('id')->on('devices')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('color_id')->nullable();
            $table->foreign('color_id')->nullable()->references('id')->on('colors')->onDelete('cascade')->onUpdate('cascade');


            $table->timestamps();
        });

        Schema::create('device_specs', function (Blueprint $table) {
            $table->id();

            $table->boolean('status')->default(1);

            $table->unsignedBigInteger('device_id');
            $table->foreign('device_id')->references('id')->on('devices')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('specs_id');
            $table->foreign('specs_id')->references('id')->on('specs')->onDelete('cascade')->onUpdate('cascade');

            $table->longText('desc_ar')->nullable();
            $table->longText('desc_en')->nullable();

            $table->timestamps();
        });

        Schema::create('device_feature', function (Blueprint $table) {
            $table->id();

            $table->boolean('status')->default(1);

            $table->unsignedBigInteger('device_id');
            $table->foreign('device_id')->references('id')->on('devices')->onDelete('cascade')->onUpdate('cascade');

            $table->string('title_ar')->nullable();
            $table->string('title_en')->nullable();

            $table->longText('desc_ar')->nullable();
            $table->longText('desc_en')->nullable();

            $table->string('image')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('device_feature');
        Schema::dropIfExists('device_specs');
        Schema::dropIfExists('device_gallery');
        Schema::dropIfExists('device_accessory');
        Schema::dropIfExists('device_category');
        Schema::dropIfExists('devices');
    }
}
