<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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

    public function getLoginImageUrlAttribute()
    {
        return (!empty($this->attributes['login_image'])) ? url('') . Storage::url($this->attributes['login_image']) : null;
    }

    public function getHomeImageUrlAttribute()
    {
        return (!empty($this->attributes['home_image'])) ? url('') . Storage::url($this->attributes['home_image']) : null;
    }

    public function employee()
    {
        return $this->belongsTo(Employe::class, 'employee_id');
    }
}
