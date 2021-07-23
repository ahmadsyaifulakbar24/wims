<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checklist extends Model
{
    use HasFactory;

    protected $table = 'checklists';
    protected $fillable = [
        'task_id',
        'title',
    ];

    public function checklist_item()
    {
        return $this->hasMany(ChecklistItem::class, 'checklist_id');
    }
}
