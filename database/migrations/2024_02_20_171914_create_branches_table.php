<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('country_id')->nullable();
            $table->string('title_ar')->nullable();
            $table->string('title_en')->nullable();
            $table->string('phone')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('email')->nullable();
            $table->text('address_ar')->nullable();
            $table->text('address_en')->nullable();
            $table->boolean('delivery')->default(1);
            $table->boolean('pickup')->default(1);
            $table->boolean('dinein')->default(1);
            $table->boolean('status')->default(1);
            $table->string('lat')->nullable();
            $table->string('long')->nullable();
            $table->timestamps();
            
            $table->foreign('country_id', 'branches_country_id_foreign')->references('id')->on('countries')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('branches');
    }
}
