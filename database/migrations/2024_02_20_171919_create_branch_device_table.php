<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchDeviceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branch_device', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('branch_id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('device_id');
            $table->timestamps();
            
            $table->foreign('branch_id', 'branch_device_branch_id_foreign')->references('id')->on('branches')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('category_id', 'branch_device_category_id_foreign')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('device_id', 'branch_device_device_id_foreign')->references('id')->on('devices')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('branch_device');
    }
}
