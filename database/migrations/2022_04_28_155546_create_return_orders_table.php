<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReturnOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('return_orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("order_id")->unsigned();
            $table->integer("need")->default(0)->comment = "0 = replacement, 1 = cashback";
            $table->longText("problem")->nullable();
            $table->integer("status")->default(0)->comment = "0 = Request Registered, 1 = Request Accepted, 2 = Request Rejected, 3 = Return Taken, 4 = Return Accepted, 5 = Return Rejected, 6 = Cashback Given, 7 = Replacement Given";
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
        Schema::dropIfExists('return_orders');
    }
}
