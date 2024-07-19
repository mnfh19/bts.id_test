<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChecklistItem extends Model
{
    use HasFactory;

    protected $table = 'checklistitem';

    protected $primaryKey = 'checklistItemId';

    protected $fillable = [
        'checklistId',
        'itemName',
        'status',
    ];

    public function checklist()
    {
        return $this->belongsTo(Checklist::class, 'checklistId', 'checklistId');
    }
}
