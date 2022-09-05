<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class SurveyResponse extends Model
{
    use HasFactory;

    protected $fillable = ['ownable_id', 'ownable_type', 'response', 'user_id'];

    protected $casts = [
        'response' => 'array',
    ];

    /**
     * @return BelongsTo<User, SurveyResponse>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return MorphTo<Model,SurveyResponse>
     */
    public function ownable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * @param Builder<SurveyResponse> $query
     * @return Builder<SurveyResponse>
     */
    public function scopeProjects(Builder $query) : Builder
    {
        return $query->where('ownable_type', Project::class);
    }

    /**
     * @param Builder<SurveyResponse> $query
     * @param Project|int $project
     * @return Builder<SurveyResponse>
     */
    public function scopeProject(Builder $query, Project|int $project) : Builder
    {
        if ($project instanceof Project)
            $project = $project->id;

        return $query->where('ownable_type', Project::class)->where('ownable_id', $project);
    }

    /**
     * @param Builder<SurveyResponse> $query
     * @return Builder<SurveyResponse>
     */
    public function scopeTasks(Builder $query) : Builder
    {
        return $query->where('ownable_type', Task::class);
    }

    /**
     * @param Builder<SurveyResponse> $query
     * @param Task|int $task
     * @return Builder<SurveyResponse>
     */
    public function scopeTask(Builder $query, Task|int $task) : Builder
    {
        if ($task instanceof Task)
            $task = $task->id;

        return $query->where('ownable_type', Task::class)->where('ownable_id', $task);
    }

    /**
     * @param Builder<SurveyResponse> $query
     * @param User|int $user
     * @return Builder<SurveyResponse>
     */
    public function scopeUser(Builder $query, User|int $user) : Builder
    {
        if ($user instanceof User)
            $user = $user->id;

        return $query->where('user_id', $user);
    }
}
