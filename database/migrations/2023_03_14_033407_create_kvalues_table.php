<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kvalues', function (Blueprint $table) {
            $table->id();
            $table->string('kecamatan');
            $table->double('t2011');
            $table->double('t2012');
            $table->double('t2013');
            $table->double('t2014');
            $table->double('t2015');
            $table->double('t2016');
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
        Schema::dropIfExists('kvalues');
    }
};
