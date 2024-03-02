<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('region_id');
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
            
            $table->foreign('client_id', 'addresses_client_id_foreign')->references('id')->on('clients')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('region_id', 'addresses_region_id_foreign')->references('id')->on('regions')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
