<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class SurveyResponse extends Model
{
    use HasFactory;

    protected $fillable = ['ownable_id', 'ownable_type', 'response', 'user_id'];

    protected $casts = [
        'response' => 'array'
    ];

    public function ownable() : MorphTo
    {
        return $this->morphTo();
    }

    public function scopeProjects($query)
    {
        return $query->where('ownable_type', Project::class);
    }

    public function scopeProject($query, Project|int $project)
    {
        if ($project instanceof Project)
            $project = $project->id;
        return $query->where('ownable_type', Project::class)->where('ownable_id', $project);
    }

    public function scopeTasks($query)
    {
        return $query->where('ownable_type', Task::class);
    }

    public function scopeTask($query, Task|int $task)
    {
        if ($task instanceof Task)
            $task = $task->id;
        return $query->where('ownable_type', Task::class)->where('ownable_id', $task);
    }

    public function scopeUser($query, User|int $user)
    {
        if ($user instanceof User)
            $user = $user->id;
        return $query->where('user_id', $user);
    }
}
