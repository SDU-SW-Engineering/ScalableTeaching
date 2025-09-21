<?php

namespace App\Models;

use Database\Factories\SubTaskGroupFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SubTaskGroup extends Model
{
    /** @use HasFactory<SubTaskGroupFactory> */
    use HasFactory;

    protected $fillable = ['name', 'description', 'sort_order', 'visible'];

    public function subTasks(): HasMany
    {
        return $this->hasMany(SubTask::class);
    }
}
