<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchesTable extends Migration
{
    public function up()
    {
        Schema::create('branches', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('country_id')->nullable();
            $table->foreign('country_id')->nullable()->on('countries')->references('id')->onDelete('cascade')->onUpdate('cascade');

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
        });

        Schema::create('branch_region', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('branch_id');
            $table->foreign('branch_id')->on('branches')->references('id')->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('region_id');
            $table->foreign('region_id')->on('regions')->references('id')->onUpdate('cascade')->onDelete('cascade');

            $table->timestamps();
        });

        Schema::create('branch_category', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('branch_id');
            $table->foreign('branch_id')->on('branches')->references('id')->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->nullable()->on('categories')->references('id')->onUpdate('cascade')->onDelete('cascade');

            $table->timestamps();
        });
        Schema::create('branch_product', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('branch_id');
            $table->foreign('branch_id')->on('branches')->references('id')->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->nullable()->on('categories')->references('id')->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->nullable()->on('products')->references('id')->onUpdate('cascade')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('branch_products');
        Schema::dropIfExists('branch_category');
        Schema::dropIfExists('branch_region');
        Schema::dropIfExists('branches');
    }
}
