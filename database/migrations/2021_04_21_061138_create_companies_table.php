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
            $table->integer('ref_company_code')->unsigned();
            $table->foreignId('parent_id')->nullable()->constrained('companies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('employee_reach_id')->nullable()->constrained('master_params')->onDelete('cascade')->onUpdate('cascade');
            $table->enum('type', ['center','branch']);
            $table->string('name');
            $table->string('logo_path')->nullable();
            $table->text('address')->nullable();
            $table->integer('postal_code')->nullable();
            $table->foreignId('province_id')->nullable()->constrained('provinces')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('city_id')->nullable()->constrained('cities')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('umr')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('email')->nullable();
            $table->string('bpjs')->nullable();
            $table->foreignId('jkk')->nullable()->constrained('master_params')->onDelete('cascade')->onUpdate('cascade');
            $table->string('npwp')->nullable();
            $table->date('taxable_date')->nullable();
            $table->string('tax_person_name')->nullable();
            $table->string('tax_person_npwp')->nullable();
            $table->string('signature')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::table('companies', function (Blueprint $table) {
            $table->foreign('ref_company_code')->references('company_code')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
