<?php

namespace App\Models;

use Egulias\EmailValidator\Exception\UnclosedComment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';
    protected $fillable = [
        'task_id',
        'user_id',
        'user_report_id',
        'leave_id',
        'comment'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
