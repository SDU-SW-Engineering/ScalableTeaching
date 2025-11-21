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
     * @return BelongsTo<CourseRole, $this>
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(CourseRole::class, 'course_role_id');
    }

    /**
     * @return BelongsTo<Task, $this>
     */
    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }

    /**
     * Is only used for attaching or getting users for a certain delegation
     * THIS SHOULD NOT BE USED WHEN DELEGATING {@see delegationUserPool()}
     * @return BelongsToMany<User, $this>
     */
    public function userPool(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * @return HasMany<ProjectFeedback, $this>
     */
    public function feedback(): HasMany
    {
        return $this->hasMany(ProjectFeedback::class);
    }

    /**
     * @return HasManyThrough<ProjectFeedbackComment, ProjectFeedback, $this>
     */
    public function comments(): HasManyThrough
    {
        return $this->hasManyThrough(ProjectFeedbackComment::class, ProjectFeedback::class);
    }

    /**
     * @throws TaskDelegationException
     * @throws Throwable
     */
    public function delegate(): void
    {
        throw_if($this->task->ends_at->gt(now()), new TaskDelegationException('Cannot delegate before task has ended.'));
        throw_if($this->task->course->students()->count() == 1, new TaskDelegationException("Not enough students to delegate."));

        if ($this->course_role_id != 2 && ($this->number_of_projects === 0 || $this->number_of_projects >= $this->task->projects->count() - 1))
        { // Max cases where all project gets reviewed by all reviewers.
            $this->delegateAllProjects();
        } elseif ($this->course_role_id == 2 && $this->number_of_projects == 0)
        { // If projects should be equally distributed amongst teachers.
            $this->delegateAllProjects();
        } elseif ($this->course_role_id == 2 && $this->number_of_projects == 1)
        { // If projects should be equally distributed amongst teachers.
            $this->delegateSplitEqually();
        }else if ($this->course_role_id == 1)
        { // If all students should review "$this->number_of_projects" projects each.
            $this->delegateCircular();
        } else
        { // IDK when this would be hit, but in case I missed something projects will be split equally.
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
        $allProjects = $this->getEligibleProjects(); // Last part is to ensure we don't get preloaded but unused projects to grade and don't get projects where no commits have been made
        foreach ($this->delegationUserPool() as $delegationUser)
        {
            $userProject = $this->userProject($delegationUser);
            $ineligibleProjects = $userProject != null ? [$userProject] : [];

            $eligibleProjects = $allProjects->except($ineligibleProjects);
            foreach ($eligibleProjects as $project)
            {
                /**
                 * @var Project $project
                 */
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
        $projects = $this->getEligibleProjects(); // Last part is to ensure we don't get preloaded but unused projects to grade and don't get projects where no commits have been made
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
                /**
                 * @var Project $projectToAssign
                 */
                $this->processProjectUpdate($projectToAssign, $delegationUser, $delayCounter);
            }
        }
    }

    private function delegateSplitEqually(): void
    {
        $delayCounter = 0;
        $userPool = $this->delegationUserPool();
        $remainingProjects = $this->getEligibleProjects();
        $userIndex = 0;
        while ($remainingProjects->count() >= 1)
        {
            $user = $userPool[$userIndex++ % count($userPool)];
            $project = $remainingProjects->filter(function (Project $project) use ($user) {return ! $project->owners()->contains($user);})->first();
            if ( ! $project)
            {
                continue;
            }
            $remainingProjects = $remainingProjects->reject(function (Project $filterProject) use ($project) {
                /**
                 * @var Project $project
                 */
                return $project->id === $filterProject->id;
            });
            /**
             * @var Project $project
             */
            $this->processProjectUpdate($project, $user, $delayCounter);
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
        $userPoolCount = $this->userPool()->count();
        if ($this->course_role_id == 1 && $userPoolCount == 0)
        {
            return $this->task->course->students->whereIn("id", $this->task->projects->where("status", "finished")->pluck("id")->toArray());
        }
        if ($this->course_role_id == 1 && $userPoolCount != 0)
        {
            return $this->task->course->students->whereIn("id", $this->task->projects->where("status", "finished")->pluck("id")->toArray())->diff($this->userPool);
        }
        if ($this->course_role_id == 2 && $userPoolCount == 0)
        {
            return $this->task->course->teachers;
        }
        if ($this->course_role_id == 2 && $userPoolCount != 0)
        {
            return $this->task->course->teachers->diff($this->userPool);
        }
        if ($this->course_role_id == null || $userPoolCount != 0)
        {
            return $this->userPool;
        }

        Log::error("Received unknown course_role_id for task delegation, received: {$this->course_role_id} - Returning empty array.");

        return Collection::empty();
    }

    /**
     * @return Collection<(int|string), Project>
     */
    public function getEligibleProjects(): Collection
    {
        return $this->task->projects->keyBy('id')->whereNotNull("ownable_id")->whereNotNull("final_commit_sha");  // To ensure we don't get preloaded but unused projects to grade and don't get projects where no commits have been made
    }
}
