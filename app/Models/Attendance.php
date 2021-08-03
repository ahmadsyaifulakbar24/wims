<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $table = 'attendances';
    protected $fillable = [
        'employee_id',

        // login time
        'login_image',
        'login_time',
        'login_latitude',
        'login_longitude',
        'login_description',

        // home time
        'home_image',
        'home_time',
        'home_latitude',
        'home_longitude',
        'home_description',
    ];

    protected $appends = [
        'login_image_url',
        'home_image_url'
    ];

    public function getLoginImageUrl()
    {
        return url('') . Storage::url($this->attributes['login_image_url']);
    }

    public function HomeLoginImageUrl()
    {
        return url('') . Storage::url($this->attributes['home_image_url']);
    }

    public function employee()
    {
        return $this->belongsTo(Employe::class, 'employee_id');
    }
}
