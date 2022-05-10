<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicationStandardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publication_standards', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('publication_id')->unsigned()->index();
            $table->bigInteger('standard_id')->unsigned()->index();

            $table->foreign('publication_id')->references('id')->on('publications')->onDelete('cascade');
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
        Schema::dropIfExists('publication_standards');
    }
}
