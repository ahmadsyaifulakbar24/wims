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
        'parent_id',
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
        'jkk',
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
        return url('') . Storage::url($this->attributes['logo_path']);
    }

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
}
