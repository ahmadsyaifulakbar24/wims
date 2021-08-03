<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'phone_number',
        'profile_photo_path',
        'password',
        'role_id',
        'active',
        'company_code',
        'company_code_parent'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function getProfilePhotoUrlAttribute()
    {
        return (!empty($this->attributes['profile_photo_path'])) ? url('') . Storage::url($this->attributes['profile_photo_path']) : "https://ui-avatars.com/api/?name=" . str_replace(' ', '+', $this->attributes['name']) . "&color=7F9CF5&background=EBF4FF";
    }

    public static function boot()
    {
        parent::boot();
        static::deleting(function($employee) {
            $employee->employee()->delete();
        });
    }

    public function user_role()
    {
        return $this->belongsTo(UserRole::class, 'role_id');
    }

    public function employee()
    {
        return $this->hasOne(Employe::class, 'user_id');
    }

    public function board()
    {
        return $this->belongsToMany(Board::class, 'board_memebers', 'user_id', 'board_id');
    }

    public function task()
    {
        return $this->belongsToMany(Task::class, 'task_members', 'user_id', 'task_id');
    }

    public function company()
    {
        return $this->hasMany(Company::class, 'ref_company_code', 'company_code');
    }
}
