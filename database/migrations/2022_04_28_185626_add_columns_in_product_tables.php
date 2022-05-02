<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsInProductTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->boolean('can_return')->default(0)->comment('0 = can not return, 1 = can return')->after('is_active');
            $table->integer('give_needed_item')->default(0)->comment('0 = nothing, 1 = replacement, 2 = cashback, 3 = both')->after('is_active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('can_return');
            $table->dropColumn('give_needed_item');
        });
    }
}
