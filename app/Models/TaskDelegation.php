<?php

namespace App\Models;

use App\Exceptions\TaskDelegationException;
use App\Jobs\Project\DownloadProject;
use App\Jobs\Project\IndexRepositoryChanges;
use App\Models\Enums\TaskDelegationType;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Facades\Log;
use Throwable;

/**
 * @property int $id
 * @property-read Task $task
 * @property TaskDelegationType $type
 * @property bool $delegated
 * @property bool $is_anonymous
 * @property bool $grading
 * @property Carbon $deadline_at
 * @property int|null $course_role_id
 * @property int $number_of_projects The amount of projects each user has to give feedback on
 * @property-read bool $is_moderated
 * @method static Builder undelegated() Maps to scopeUndelegated
 */
class TaskDelegation extends Model
{
    use HasFactory;

    protected $fillable = ['course_role_id', 'number_of_projects', 'type', 'grading', 'feedback', 'deadline_at', 'delegated', 'is_moderated'];

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
     * Is only used for attaching or getting users for a certain delegation
     * THIS SHOULD NOT BE USED WHEN DELEGATING {@see delegationUserPool()}
     * @return BelongsToMany<User>
     */
    public function userPool(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * @return HasMany<ProjectFeedback>
     */
    public function feedback(): HasMany
    {
        return $this->hasMany(ProjectFeedback::class);
    }

    /**
     * @return HasManyThrough<ProjectFeedbackComment>
     */
    public function comments(): HasManyThrough
    {
        return $this->hasManyThrough(ProjectFeedbackComment::class, ProjectFeedback::class);
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
     * @throws TaskDelegationException
     * @throws Throwable
     */
    public function delegate(): void
    {
        throw_if($this->task->ends_at->gt(now()), new TaskDelegationException('Cannot delegate before task has ended.'));
        throw_if($this->task->course->students()->count() == 1, new TaskDelegationException("Not enough students to delegate."));

        // Max cases where all project gets reviewed.
        if ($this->number_of_projects === 0 || $this->number_of_projects >= $this->task->projects->count() - 1)
        {
            $this->delegateAllProjects();
        } else if ($this->delegationUserPool()->count() == $this->task->course->students()->count())
        {
            $this->delegateCircular();
        } else
        {
            $this->delegateSplitEqually();
        }
        $this->update(['delegated' => true]);
    }

    /**
     * Handles delegating projects if every user should review every project.
     */
    private function delegateAllProjects(): void
    {
        $delayCounter = 0;
        $allProjects = $this->task->projects->keyBy('id');
        foreach ($this->delegationUserPool() as $delegationUser)
        {
            $userProject = $this->userProject($delegationUser);
            $ineligibleProjects = $userProject != null ? [$userProject] : [];

            $eligibleProjects = $allProjects->except($ineligibleProjects);
            foreach ($eligibleProjects as $project)
            {
                $this->processProjectUpdate($project, $delegationUser, $delayCounter);
            }

        }
    }

    /**
     * Handles delegating projects if every user should review a subset of projects.
     * It delegates with the following logic:
     * - User 0, gets projects 1, 2
     * - User 1, gets projects 2, 3
     * - User 2, gets projects 3, 0
     * - User 3, gets projects 0, 1
     */
    private function delegateCircular(): void
    {
        $delayCounter = 0;
        $projects = $this->task->projects->keyBy('id');
        $userPool = $this->delegationUserPool();
        for ($userIndex = 0; $userIndex < $userPool->count(); $userIndex++)
        {
            $delegationUser = $userPool[$userIndex];
            $userProject = $this->userProject($delegationUser);
            $ineligibleProjects = $userProject != null ? [$userProject] : [];

            $eligibleProjects = $projects->except($ineligibleProjects);
            for ($projectIndex = 0; $projectIndex < $this->number_of_projects; $projectIndex++)
            {
                $index = ($userIndex + $projectIndex) % count($eligibleProjects);

                $projectToAssign = $eligibleProjects->slice($index, 1)->first();
                $this->processProjectUpdate($projectToAssign, $delegationUser, $delayCounter);
            }
        }
    }

    private function delegateSplitEqually(): void
    {
        $delayCounter = 0;
        $userPool = $this->delegationUserPool();
        $projects = $this->task->projects->keyBy('id');
        $splitProjects = $projects->split($userPool->count());
        foreach ($userPool as $delegationUser)
        {

            $userProject = $this->userProject($delegationUser);
            //TODO:  Account for group projects.

            $ineligibleProjects = $userProject != null ? [$userProject] : [];

            /** @var Collection $eligibleProjects */
            $eligibleProjects = $splitProjects->shift()->except($ineligibleProjects);
            foreach ($eligibleProjects as $projectId)
            {
                $this->processProjectUpdate($projects->get($projectId), $delegationUser, $delayCounter);
            }
        }
    }

    private function processProjectUpdate(Project $project, User $delegationUser, int &$delayCounter): void
    {
        $projectPush = $this->relevantPush($project);
        if ($projectPush == null || $projectPush->after_sha == null)
            return;

        $project->feedback()->create([
            'sha'                => $projectPush->after_sha,
            'task_delegation_id' => $this->id,
            'user_id'            => $delegationUser->id,
        ]);

        IndexRepositoryChanges::dispatch($project, $projectPush->after_sha)->onQueue('index')->delay(now()->addMinutes($delayCounter / 2));
        $delayCounter++;

        if ($project->download()->exists())
            return; // download is already queued.

        $download = $project->download()->create([
            'ref'       => $projectPush->after_sha,
            'expire_at' => now()->addYears(2),
        ]);
        DownloadProject::dispatch($download)->onQueue('downloads')->delay(now()->addMinutes($delayCounter / 2));
        $delayCounter++;
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
     * @param Project $project
     * @return ProjectPush|null The push
     * @throws Exception
     */
    private function relevantPush(Project $project): ?ProjectPush
    {
        /** @var ProjectPush|null $latestProjectPush */
        $latestProjectPush = $project->relevantPushes()->first();

        return $latestProjectPush;
    }

    /**
     * Returns the pool of users that should be delegated to.
     * @return Collection<int, User>
     */
    private function delegationUserPool(): Collection
    {
        if ($this->course_role_id == 1)
        {
            return $this->task->course->students;
        }
        if ($this->course_role_id == 2)
        {
            return $this->task->course->teachers;
        }
        if ($this->course_role_id == null)
        {
            return $this->userPool;
        }

        Log::error("Received unknown course_role_id for task delegation, received: {$this->course_role_id} - Returning empty array.");

        return Collection::empty();
    }

    public function userPoolCount(): int
    {
        return $this->delegationUserPool()->count();
    }

    public function courseRoleName(): string
    {
        if ($this->course_role_id == 1)
        {
            return 'Student';
        }
        if ($this->course_role_id == 2)
        {
            return 'Teacher';
        }

        return 'User';
    }
}
