<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TaskDelegation extends Model
{
    use HasFactory;

    protected $fillable = ['course_role_id', 'number_of_tasks'];

    /**
     * @return BelongsTo<CourseRole,TaskDelegation>
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(CourseRole::class, 'course_role_id');
    }
}
