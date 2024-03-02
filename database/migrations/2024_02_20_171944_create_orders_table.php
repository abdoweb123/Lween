<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->unsignedBigInteger('delivery_id')->nullable();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('address_id')->nullable();
            $table->unsignedBigInteger('branch_id')->nullable();
            $table->unsignedBigInteger('payment_id');
            $table->decimal('sub_total', 9, 3)->default(0.000);
            $table->decimal('discount', 9, 3)->default(0.000);
            $table->integer('discount_percentage')->default(0);
            $table->decimal('vat', 9, 3)->default(0.000);
            $table->integer('vat_percentage')->default(0);
            $table->decimal('coupon', 9, 3)->default(0.000);
            $table->integer('coupon_percentage')->default(0);
            $table->decimal('charge_cost', 9, 3)->default(0.000);
            $table->decimal('net_total', 9, 3)->default(0.000);
            $table->integer('status')->default(0);
            $table->integer('follow')->default(0);
            $table->timestamps();
            
            $table->foreign('address_id', 'orders_address_id_foreign')->references('id')->on('addresses')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('branch_id', 'orders_branch_id_foreign')->references('id')->on('branches')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('client_id', 'orders_client_id_foreign')->references('id')->on('clients')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('delivery_id', 'orders_delivery_id_foreign')->references('id')->on('deliveries')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('payment_id', 'orders_payment_id_foreign')->references('id')->on('payments')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
