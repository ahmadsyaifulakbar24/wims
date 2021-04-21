<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
