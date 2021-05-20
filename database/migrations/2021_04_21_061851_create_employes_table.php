<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employes', function (Blueprint $table) {
            $table->id();

            // personal data
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('employee_id')->unique();
            $table->string('barcode')->nullable();
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->enum('identity_type', ['ktp','passport'])->nullable();
            $table->date('expired_date_identity')->nullable();
            $table->string('no_identity')->nullable();
            $table->integer('postal_code')->nullable();
            $table->text('identity_address')->nullable();
            $table->text('residential_address')->nullable();
            $table->string('place_of_birth')->nullable();
            $table->date('date_of_birth');
            $table->string('mobile_phone')->nullable();
            $table->string('phone')->nullable();
            $table->enum('gender', ['male', 'female']);
            $table->foreignId('marital_status_id')->constrained('master_params')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('blood_type_id')->nullable()->constrained('master_params')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('religion_id')->constrained('master_params')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('education_id')->nullable()->constrained('master_params')->onDelete('cascade')->onUpdate('cascade');

            // company detail
            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('organization_id')->constrained('params')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('job_position_id')->constrained('params')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('job_level_id')->constrained('params')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('employee_status_id')->constrained('params')->onDelete('cascade')->onUpdate('cascade');
            $table->date('join_date');
            $table->date('end_date')->nullable();
            

            // payrol
            $table->bigInteger('basic_salary');
            $table->string('npwp')->nullable();
            $table->foreignId('ptkp_id')->nullable()->constrained('master_params')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('bank_id')->unsigned()->nullable();
            $table->string('bank_account')->nullable();
            $table->string('bank_account_holder')->nullable();
            $table->string('bpjs_ketenagakerjaan')->nullable();
            $table->string('bpjs_kesehatan')->nullable();
            $table->integer('bpjs_kesehatan_family')->nullable();
            $table->enum('type_salary', ['monthly', 'daily']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employes');
    }
}
