<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;

    protected $table = 'divisions';
    protected $fillable = [
        'user_id',
        'pic_id',
        'name'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function pic()
    {
        return $this->belongsTo(User::class, 'pic_id');
    }

    public function board()
    {
        return $this->hasMany(Board::class, 'division_id');
    }
}
