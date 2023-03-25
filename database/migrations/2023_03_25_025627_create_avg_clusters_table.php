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
        Schema::create('avg_clusters', function (Blueprint $table) {
            $table->id();
            $table->double('avg_c1')->nullable();
            $table->double('avg_c2')->nullable();
            $table->double('avg_c3')->nullable();
            $table->double('avg_c4')->nullable();
            $table->double('avg_c5')->nullable();
            $table->double('avg_c6')->nullable();
            $table->double('avg_c7')->nullable();
            $table->double('avg_c8')->nullable();
            $table->double('avg_c9')->nullable();
            $table->double('avg_c10')->nullable();
            $table->double('avg_c11')->nullable();
            $table->double('avg_c12')->nullable();
            $table->double('avg_c13')->nullable();
            $table->double('avg_c14')->nullable();
            $table->double('avg_c15')->nullable();
            $table->double('avg_c16')->nullable();
            $table->double('avg_c17')->nullable();
            $table->double('avg_c18')->nullable();
            $table->double('avg_c19')->nullable();
            $table->double('avg_c20')->nullable();
            $table->double('avg_c21')->nullable();
            $table->double('avg_c22')->nullable();
            $table->double('avg_c23')->nullable();
            $table->double('avg_c24')->nullable();
            $table->double('avg_c25')->nullable();
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
        Schema::dropIfExists('avg_clusters');
    }
};
