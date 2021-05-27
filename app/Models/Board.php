<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Board extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'boards';
    protected $fillable = [
        'division_id',
        'title',
        'description'
    ];

    public function division()
    {
        return $this->belongsTo(Division::class, 'division_id');
    }

    public function board_member()
    {
        return $this->belongsToMany(User::class, 'board_members', 'board_id', 'user_id');
    }

    public function board_label()
    {
        return $this->hasMany(BoardLabel::class, 'board_id');
    }
}
