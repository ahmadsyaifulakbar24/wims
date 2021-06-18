<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Employe extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'employes';
    protected $fillable = [
        'user_id',
        'employee_id',
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
        'employee_status_id',
        'join_date',
        'end_date',
        'leave',

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

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeJoinUser($query)
    {
        return $query->leftJoin('users', 'employes.user_id', '=', 'users.id');
    }
    
    public function marital_status()
    {
        return $this->belongsTo(MasterParam::class, 'marital_status_id');
    }

    public function blood_type()
    {
        return $this->belongsTo(MasterParam::class, 'blood_type_id');
    }

    public function religion()
    {
        return $this->belongsTo(MasterParam::class, 'religion_id');
    }

    public function education()
    {
        return $this->belongsTo(MasterParam::class, 'education_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function organization()
    {
        return $this->belongsTo(Param::class, 'organization_id');
    }

    public function job_position()
    {
        return $this->belongsTo(Param::class, 'job_position_id');
    }

    public function employee_status()
    {
        return $this->belongsTo(Param::class, 'employee_status_id');
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class, 'bank_id');
    }

    
}
