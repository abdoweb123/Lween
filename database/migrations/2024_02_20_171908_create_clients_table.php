<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('image')->nullable();
            $table->boolean('status')->default(1);
            $table->string('password')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->unsignedBigInteger('country_id');
            $table->rememberToken();
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
            
            $table->foreign('country_id', 'clients_country_id_foreign')->references('id')->on('countries')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
