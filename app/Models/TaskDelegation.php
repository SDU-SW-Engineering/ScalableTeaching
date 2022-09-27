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
    public function task(): BelongsTo
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
    public function scopeUndelegated(Builder $query): Builder
    {
        return $query->where('delegated', false);
    }

    /**
     * @throws \Throwable
     */
    public function delegate(): void
    {
        throw_if($this->task->ends_at->gt(now()), new TaskDelegationException('Cannot delegate before task has ended.'));
        throw_if($this->task->course->students()->count() == 1, new TaskDelegationException("Not enough students to delegate."));
        /** @var Collection<int,Project> $projects */
        $projects = $this->task->projects->keyBy('id');

        $remainingTasks = $this->projectCounter($projects);

        foreach($this->task->course->students as $user) {
            if($remainingTasks->count() == 0)
                $remainingTasks = $this->projectCounter(); // out of tasks, replenish to start over
            
            $ineligibleTasks = [];
            $userProject = $this->userProject($user);
            if($userProject != null)
                $ineligibleTasks[] = $userProject;

            for($i = 0; $i < $this->number_of_tasks; $i++) {
                $project = null;
                do // keep looking for a valid repo to assign to the user
                {
                    $projectId = $this->pickRandomProject($remainingTasks, $ineligibleTasks);
                    $sha = $this->relevantPush($projects[$projectId]);
                    if($sha == null)
                        continue;
                    $project = $projects[$projectId];
                } while($project == null);

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
                $ineligibleTasks[] = $projectId;
                DownloadProject::dispatch($download)->onQueue('downloads');
                IndexRepositoryChanges::dispatch($download->project, $download->ref)->onQueue('index');
            }
        }
        $this->update(['delegated' => true]);
    }

    /**
     * @param Collection<int,Project> $projects
     * @return Collection<int, int>
     */
    private function projectCounter(Collection $projects): \Illuminate\Support\Collection
    {
        return $projects->mapWithKeys(fn(Project $project) => [$project->id => $this->number_of_tasks]);
    }

    /**
     * Returns the project the user is working on for the task (if any)
     * @param User $user
     * @return int|null
     */
    private function userProject(User $user): ?int
    {
        $userProjects = $this->task->userProjectDictionary();

        return $userProjects->has($user->id) ? $userProjects[$user->id] : null;
    }

    /**
     * @param \Illuminate\Support\Collection<int,int> $tasks
     * @param array $exclude
     * @return int
     */
    private function pickRandomProject(\Illuminate\Support\Collection &$tasks, array $exclude = []): int
    {
        do {
            $eligibleTasks = $tasks->reject(fn(int $counter, int $projectId) => in_array($projectId, $exclude));
            if ($eligibleTasks->count() == 0)
            {
                // This user is out of eligible tasks, take frrom general pool.
                $eligibleTasks = $this->projectCounter($this->task->projects)
                    ->reject(fn(int $counter, int $projectId) => in_array($projectId, $exclude));
                $tasks = $eligibleTasks;
            }
            $pickedProjectId = $eligibleTasks->keys()[rand(0, $eligibleTasks->count() - 1)];
            if($tasks[$pickedProjectId] == 0) {
                $tasks->forget($pickedProjectId);
                $pickedProjectId = null;
                continue;
            }

            $tasks[$pickedProjectId] = $tasks[$pickedProjectId] - 1;
            if ($tasks[$pickedProjectId] == 0)
                $tasks->forget($pickedProjectId);
        } while($pickedProjectId == null);

        return $pickedProjectId;
    }

    /**
     * @param Project $project
     * @return string|null Sha value of the push
     */
    private function relevantPush(Project $project): ?string
    {
        return match ($this->type) {
            TaskDelegationType::LastPushes => $project
                ->pushes()
                ->isAccepted($project->task)
                ->isValid()
                ->first()
                ?->after_sha,
            TaskDelegationType::SucceedingPushes => throw new \Exception('To be implemented'),
            TaskDelegationType::SucceedingOrLastPushes => throw new \Exception('To be implemented')
        };
    }
}
