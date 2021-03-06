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
        'user_report_id',
        'name',
        'file_url',
        'type',
    ];

    public function setFileUrlAttribute($value)
    {
        $this->attributes['file_url'] = url('storage/'.$value);
    }
}
