<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterParamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_params', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')->nullable()->constrained('master_params')->onDelete('cascade')->onUpdate('cascade');
            $table->string('category');
            $table->string('name');
            $table->integer('order')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_params');
    }
}
