<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePtkpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ptkp', function (Blueprint $table) {
            $table->id();
            $table->string('ptkp')->unique();
            $table->bigInteger('rate');
            $table->text('description')->nullable();
        });

        Schema::table('employes', function (Blueprint $table) {
            $table->foreign('ptkp_id')->references('id')->on('ptkp')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ptkp');
    }
}
