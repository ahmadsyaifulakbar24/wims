<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoardLabel extends Model
{
    use HasFactory;

    protected $table = 'board_labels';
    protected $fillable = [
        'board_id',
        'name',
        'color',
    ];
}
