<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskAttachment extends Model
{
    use HasFactory;

    protected $table = 'task_attachments';
    protected $fillable = [
        'task_id',
        'name',
        'file_url',
        'type',
    ];
}
