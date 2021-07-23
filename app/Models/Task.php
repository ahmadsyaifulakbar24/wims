<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory;
    use SoftDeletes;

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

    public function task_member_many()
    {
        return $this->hasMany(TaskMember::class, 'task_id');
    }

    public function checklist()
    {
        return $this->hasMany(Checklist::class, 'task_id');
    }

    public function attachment()
    {
        return $this->hasMany(TaskAttachment::class, 'task_id');
    }

    public function comment()
    {
        return $this->hasMany(Comment::class, 'task_id');
    }
}
