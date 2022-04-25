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
            $table->bigInteger('user_id')->unsigned();
            $table->string('order_no');
            $table->longText('order_item_ids')->nullable();
            $table->longText('order_item_quantities')->nullable();
            $table->longText('order_item_prices')->nullable();
            $table->longText('order_item_total_prices')->nullable();
            $table->decimal('main_total', 10, 2)->default(0.00);
            $table->string('shipping_phone')->nullable();
            $table->string('shipping_email')->nullable();
            $table->longText('shipping_street')->nullable();
            $table->longText('shipping_street2')->nullable();
            $table->string('shipping_city')->nullable();
            $table->string('shipping_state')->nullable();
            $table->string('shipping_country')->nullable();
            $table->string('shipping_zipcode')->nullable();
            $table->string('billing_phone')->nullable();
            $table->string('billing_email')->nullable();
            $table->longText('billing_street')->nullable();
            $table->longText('billing_street2')->nullable();
            $table->string('billing_city')->nullable();
            $table->string('billing_state')->nullable();
            $table->string('billing_country')->nullable();
            $table->string('billing_zipcode')->nullable();
            $table->string('payment_method')->default('cash')->comment = "cash, razorpay";
            $table->integer('order_state')->default(0)->comment = "0 = Received, 1 = Shipped, 2 = Delivered, 3 = Cancelled, 4 - Rejected";
            $table->timestamps();
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
