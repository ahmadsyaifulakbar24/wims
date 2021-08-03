<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskLabel extends Model
{
    use HasFactory;

    protected $table = 'task_labels';
    protected $fillable = [
        'task_id',
        'board_label_id'
    ];

    public $timestamps = false;
}
