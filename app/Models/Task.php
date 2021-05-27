<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $table = 'tasks';
    protected $fillable = [
        'board_id',
        'title',
        'start_due_date',
        'finish_due_date',
        'description'
    ];

    public function task_members()
    {
        return $this->belongsToMany(User::class, 'task_members', 'task_id', 'user_id');
    }
}
