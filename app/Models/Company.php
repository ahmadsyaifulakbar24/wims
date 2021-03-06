<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Company extends Model
{
    use HasFactory;

    protected $table = 'companies';
    protected $fillable = [
        'ref_company_code',
        'employee_reach_id',
        'parent_id',
        'type',
        'name',
        'logo_path',
        'address',
        'postal_code',
        'province_id',
        'city_id',
        'umr',
        'phone_number',
        'email',
        'bpjs',
        'jkk_id',
        'npwp',
        'taxable_date',
        'tax_person_name',
        'tax_person_npwp',
        'signature'
    ];

    protected $appends = [
        'logo_url',
        'signature_url'
    ];

    public function getLogoUrlAttribute()
    {
        return url('') . Storage::url($this->attributes['logo_path']);
    }

    public function getSignatureUrlAttribute()
    {
        return url('') . Storage::url($this->attributes['signature']);
    }

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function jkk()
    {
        return $this->belongsTo(MasterParam::class, 'jkk_id');
    }
}
