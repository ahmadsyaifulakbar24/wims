<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\FuncCall;

class Param extends Model
{
    use HasFactory;

    protected $table = 'params';
    protected $fillable = [
        'parent_id',
        'parent_path',
        'category',
        'param',
        'option'
    ];

    public $timestamps = false;

    public function organization_employee()
    {
        return $this->hasMany(Employe::class, 'organization_id');
    }

    public function job_level_employee()
    {
        return $this->hasMany(Employe::class, 'job_level_id');
    }

    public function job_position_employee()
    {
        return $this->hasMany(Employe::class, 'job_position_id');
    }

    public function employee_status()
    {
        return $this->hasMany(Employe::class, 'employee_status_id');
    }

    public function parent()
    {
        return $this->belongsTo(Param::class, 'parent_id');
    }
}
