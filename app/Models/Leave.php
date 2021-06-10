<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;

    protected $table = 'leaves';
    protected $fillable = [
        'employee_id',
        'total_leave',
        'description',
        'from_date',
        'till_date',
        'status'
    ];

    public function employee()
    {
        return $this->belongsTo(Employe::class, 'employee_id');
    }

    public function comment()
    {
        return $this->hasMany(Comment::class, 'leave_id');
    }
}
