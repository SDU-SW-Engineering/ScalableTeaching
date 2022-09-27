<?php

namespace App\Models;

use App\Exceptions\TaskDelegationException;
use App\Jobs\Project\DownloadProject;
use App\Jobs\Project\IndexRepositoryChanges;
use App\Models\Enums\TaskDelegationType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property-read Task $task
 * @property TaskDelegationType $type
 * @property bool $delegated
 */
class TaskDelegation extends Model
{
    use HasFactory;

    protected $fillable = ['course_role_id', 'number_of_tasks', 'type', 'grading', 'feedback', 'deadline_at', 'delegated'];

    protected $casts = [
        'type'        => TaskDelegationType::class,
        'grading'     => 'bool',
        'feedback'    => 'bool',
        'delegated'   => 'bool',
        'deadline_at' => 'datetime',
    ];

    /**
     * @return BelongsTo<CourseRole,TaskDelegation>
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(CourseRole::class, 'course_role_id');
    }

    /**
     * @return BelongsTo<Task, TaskDelegation>
     */
    public function task() : BelongsTo
    {
        return $this->belongsTo(Task::class);
    }

    /**
     * @return HasMany<ProjectFeedback>
     */
    public function feedback(): HasMany
    {
        return $this->hasMany(ProjectFeedback::class);
    }

    /**
     * @param Builder<TaskDelegation> $query
     * @return Builder<TaskDelegation>
     */
    public function scopeUndelegated(Builder $query) : Builder
    {
        return $query->where('delegated', false);
    }

    /**
     * @throws \Throwable
     */
    public function delegate() : void
    {
        throw_if($this->task->ends_at->gt(now()), new TaskDelegationException('Cannot delegate before task has ended.'));
        throw_if($this->task->course->students()->count() == 1, new TaskDelegationException("Not enough students to delegate."));
        /** @var Collection<int,Project> $projects */
        $projects = $this->task->projects;
        foreach($this->task->course->students as $user)
        {
            $this->userDelegations($projects, $user)->each(function(Project $project) use ($user) {
                $sha = $this->relevantPush($project);
                if($sha == null) //user has not pushed anything
                    return;

                $project->feedback()->create([
                    'sha'                => $sha,
                    'task_delegation_id' => $this->id,
                    'user_id'            => $user->id,
                ]);
                /** @var ProjectDownload $download */
                $download = $project->downloads()->create([
                    'ref'       => $sha,
                    'expire_at' => now()->addYears(2),
                ]);
                $this->update(['delegated' => true]);
                DownloadProject::dispatch($download)->onQueue('downloads');
                IndexRepositoryChanges::dispatch($download->project, $download->ref)->onQueue('index');
            });
        }
    }

    /**
     * @param Project $project
     * @return string|null Sha value of the push
     */
    private function relevantPush(Project $project): ?string
    {
        return match ($this->type)
        {
            TaskDelegationType::LastPushes => $project
                ->pushes()
                ->isAccepted($project->task)
                ->isValid()
                ->first()
                ?->after_sha,
            TaskDelegationType::SucceedingPushes       => throw new \Exception('To be implemented'),
            TaskDelegationType::SucceedingOrLastPushes => throw new \Exception('To be implemented')
        };
    }

    /**
     * @param Collection<int,Project> $projects
     * @param User $user
     * @return Collection<int,Project>
     */
    private function userDelegations(Collection $projects, User $user): Collection
    {
        $userProjects = $this->task->userProjectDictionary();

        return $projects
            ->reject(fn(Project $project) => $userProjects->has($user->id) && $project->id == $userProjects[$user->id])
            ->shuffle()
            ->take($this->number_of_tasks);
    }
}
