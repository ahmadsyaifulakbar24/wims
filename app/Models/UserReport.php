<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserReport extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = 'user_reports';
    protected $fillable = [
        'user_id',
        'title',
        'description'
    ];

    public function attachment()
    {
        return $this->hasMany(TaskAttachment::class, 'user_report_id');
    }

    public function comment()
    {
        return $this->hasMany(Comment::class, 'user_report_id');
    }
}
