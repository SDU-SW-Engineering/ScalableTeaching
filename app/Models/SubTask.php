<?php

namespace App\Models;

use Database\Factories\SubTaskFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubTask extends Model
{
    /** @use HasFactory<SubTaskFactory> */
    use HasFactory;

    protected $fillable = ['name', 'description', 'git_workflow_name', 'points', 'sort_order', 'visible'];

    public function subTaskGroup(): BelongsTo
    {
        return $this->belongsTo(SubTaskGroup::class);
    }
}
