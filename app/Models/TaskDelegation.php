<?php

namespace App\Models;

use App\Models\Enums\TaskDelegationType;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property-read Task $task
 * @property TaskDelegationType $type
 */
class TaskDelegation extends Model
{
    use HasFactory;

    protected $fillable = ['course_role_id', 'number_of_tasks', 'type', 'grading', 'feedback', 'deadline_at', 'delegated'];

    protected $casts = [
        'type'      => TaskDelegationType::class,
        'grading'   => 'bool',
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

    /**
     * @return BelongsTo<Task>
     */
    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function delegate()
    {
        /** @var Collection<Project> $projects */
        $projects = $this->task->projects;
        foreach($this->task->course->students as $user) {
            $this->userDelegations($projects, $user)->each(function(Project $project) use ($user) {
                $sha = $this->relevantPush($project);
                if($sha == null)
                    return;

                $project->feedback()->create([
                    'sha'                => $sha,
                    'task_delegation_id' => $this->id,
                    'user_id'            => $user->id,
                ]);
            });
        }
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
                ?->after_sha
        };
    }

    /**
     * @param Collection $projects
     * @param User $user
     * @return Collection<Project>
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
