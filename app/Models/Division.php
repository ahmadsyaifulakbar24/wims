<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;

    protected $table = 'divisions';
    protected $fillable = [
        'ref_company_code',
        'pic_id',
        'name'
    ];

    public function pic()
    {
        return $this->belongsTo(User::class, 'pic_id');
    }

    public function board()
    {
        return $this->hasMany(Board::class, 'division_id');
    }
}
