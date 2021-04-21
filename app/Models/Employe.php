<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    use HasFactory;

    protected $table = 'employes';
    protected $fillable = [
        'user_id',
        'employe_id',
        'barcode',
        'first_name',
        'last_name',
        'identity_type',
        'expired_date_identity',
         'no_identity',
        'postal_code',
        'identity_address',
        'residential_address',
        'place_of_birth',
        'date_of_birth',
        'mobile_phone',
        'phone',
        'gender_id',
        'marital_status_id',
        'blood_type_id',
        'religion_id',
        'education_id',

        // Company Detail
        'company_id',
        'organization_id',
        'job_position_id',
        'job_level_id',
        'employe_status_id',
        'join_date',
        'end_date',

        // Payrol
        'basic_salary',
        'npwp',
        'ptkp_id',
        'bank_id',
        'bank_account',
        'bank_account_holder',
        'bpjs_ketenagakerjaan',
        'bpjs_kesehatan',
        'bpjs_kesehatan_family',
        'type_salary',
    ];
}
