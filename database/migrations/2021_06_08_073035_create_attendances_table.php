<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employes')->onDelete('cascade')->onUpdate('cascade');

            // login time
            $table->string('login_image');
            $table->timestamp('login_time');
            $table->string('login_latitude');
            $table->string('login_longitude');
            $table->text('login_description')->nullable();

            // home time
            $table->string('home_image')->nullable();
            $table->timestamp('home_time')->nullable();
            $table->string('home_latitude')->nullable();
            $table->string('home_longitude')->nullable();
            $table->text('home_description')->nullable();

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
        Schema::dropIfExists('attendances');
    }
}
