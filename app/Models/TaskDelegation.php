<?php

namespace App\Models;

use App\Models\Enums\TaskDelegationType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TaskDelegation extends Model
{
    use HasFactory;

    protected $fillable = ['course_role_id', 'number_of_tasks', 'type', 'grading', 'feedback', 'deadline_at', 'delegated'];

    protected $casts = [
        'type'      => TaskDelegationType::class,
        'grading'  => 'bool',
        'feedback'  => 'bool',
        'delegated' => 'bool',
    ];

    public $timestamps = ['deadline_at'];

    /**
     * @return BelongsTo<CourseRole,TaskDelegation>
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(CourseRole::class, 'course_role_id');
    }

    public function delegateTasks()
    {

    }
}
