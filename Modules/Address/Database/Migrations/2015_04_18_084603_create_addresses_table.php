<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    public function up()
    {

        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->on('clients')->references('id')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('region_id');
            $table->foreign('region_id')->on('regions')->references('id')->onUpdate('cascade')->onDelete('cascade');
            $table->string('lat')->nullable();
            $table->string('long')->nullable();
            $table->string('block', 100)->nullable();
            $table->string('road', 100)->nullable();
            $table->string('street', 100)->nullable();
            $table->string('building_no', 100)->nullable();
            $table->string('floor_no', 100)->nullable();
            $table->string('apartment', 100)->nullable();
            $table->string('type')->nullable();
            $table->text('additional_directions')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('');
        Schema::dropIfExists('addresses');
    }
}
