<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChecklistItem extends Model
{
    use HasFactory;

    protected $table = 'checklist_items';
    protected $fillable = [
        'checklist_id',
        'item',
        'start_due_date',
        'finish_due_date',
        'assign_id'
    ];
}
