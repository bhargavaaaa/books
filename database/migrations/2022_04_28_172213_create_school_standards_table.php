<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolStandardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_standards', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('school_id')->unsigned()->index();
            $table->bigInteger('standard_id')->unsigned()->index();

            $table->foreign('school_id')->references('id')->on('schools')->onDelete('cascade');
            $table->foreign('standard_id')->references('id')->on('standards')->onDelete('cascade');
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
        Schema::dropIfExists('school_standards');
    }
}
