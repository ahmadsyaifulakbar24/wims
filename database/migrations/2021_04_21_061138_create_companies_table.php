<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')->nullable()->constrained('companies')->onDelete('cascade')->onUpdate('cascade');
            $table->enum('type', ['center','branch']);
            $table->string('name');
            $table->string('logo_path');
            $table->text('address');
            $table->integer('postal_code');
            $table->foreignId('province_id')->constrained('provinces')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('city_id')->constrained('cities')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('umr')->nullable();
            $table->string('phone_number');
            $table->string('email');
            $table->string('bpjs');
            $table->string('jkk');
            $table->string('npwp');
            $table->date('taxable_date');
            $table->string('tax_person_name');
            $table->string('tax_person_npwp');
            $table->string('signature');
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
        Schema::dropIfExists('companies');
    }
}
