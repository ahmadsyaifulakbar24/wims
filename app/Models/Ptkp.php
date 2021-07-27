<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ptkp extends Model
{
    use HasFactory;

    protected $table = 'ptkp';
    protected $fillable = [
        'ptkp',
        'rate',
        'description'
    ];

    public $timestamps = false;
}
