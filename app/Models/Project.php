<?php

namespace App\Models;

use App\Events\ProjectCreated;
use App\Models\Enums\CorrectionType;
use App\ProjectStatus;
use Carbon\Carbon;
use Carbon\CarbonInterface;
use GrahamCampbell\GitLab\GitLabManager;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Project
 *
 * @property int $id
 * @property int $project_id
 * @property int $task_id
 * @property string $repo_name
 * @property ProjectStatus $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static Builder|Project newModelQuery()
 * @method static Builder|Project newQuery()
 * @method static Builder|Project query()
 * @method static Builder|Project whereCreatedAt($value)
 * @method static Builder|Project whereId($value)
 * @method static Builder|Project whereProjectId($value)
 * @method static Builder|Project whereRepoName($value)
 * @method static Builder|Project whereStatus($value)
 * @method static Builder|Project whereTaskId($value)
 * @method static Builder|Project whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int|null $ownable_id
 * @property string|null $ownable_type
 * @method static Builder|Project whereOwnableId($value)
 * @method static Builder|Project whereOwnableType($value)
 * @property-read Model|\Eloquent $ownable
 * @property int $verified
 * @property string|null $final_commit_sha
 * @property \Illuminate\Support\Carbon|null $finished_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read Task $task
 * @method static \Illuminate\Database\Query\Builder|Project onlyTrashed()
 * @method static Builder|Project whereDeletedAt($value)
 * @method static Builder|Project whereFinalCommitSha($value)
 * @method static Builder|Project whereFinishedAt($value)
 * @method static Builder|Project whereVerified($value)
 * @method static \Illuminate\Database\Query\Builder|Project withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Project withoutTrashed()
 * @property Grade $grade
 */
class Project extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['finished_at'];

    protected $casts = [
        'validation_errors' => 'array',
        'status'            => ProjectStatus::class
    ];

    protected $hidden = ['final_commit_sha', 'validation_errors', 'validated_at'];

    protected $fillable = [
        'project_id', 'task_id', 'repo_name', 'status', 'ownable_type', 'ownable_id',
        'final_commit_sha', 'created_at', 'finished_at', 'validation_errors', 'validated_at', 'hook_id'
    ];

    protected $dispatchesEvents = [
        'created' => ProjectCreated::class
    ];

    public function ownable()
    {
        return $this->morphTo();
    }

    public function pipelines()
    {
        return $this->hasMany(Pipeline::class);
    }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function subTasks()
    {
        return $this->hasMany(ProjectSubTask::class);
    }

    /**
     * returns a collection of users that own the project
     * @return Collection
     */
    public function owners()
    {
        if ($this->ownable_type == User::class)
            return Collection::wrap($this->ownable);
        return $this->ownable->users()->get();
    }

    public function unprotectBranches()
    {
        $gitLabManager = app(GitLabManager::class);
        $tries         = 3;
        do
        {
            sleep(1);  // todo: this should be switched out with a queue worker that is delayed
            $project = $gitLabManager->projects()->show($this->project_id);
            if ($project['import_error'] != null)
                break;
            if ($project['import_status'] == 'finished')
            {
                $protectedBranches = collect($gitLabManager->projects()->protectedBranches($this->project_id));
                $protectedBranches->each(function ($protectedBranch) use ($gitLabManager)
                {
                    $gitLabManager->repositories()->unprotectBranch($this->project_id, $protectedBranch['name']);
                });
                break;
            }
            $tries--;
        }
        while ($tries != 0);
    }

    public function getDurationAttribute()
    {
        if ($this->finished_at == null)
            return null;

        return number_format($this->created_at->diffInHours($this->finished_at) / 24, 2);
    }

    public function dailyBuilds($withToday = false) : \Illuminate\Support\Collection
    {
        return $this->pipelines()->daily($this->task->starts_at->startOfDay(), $this->task->earliestEndDate(! $withToday))->get();
    }

    public function getValidationStatusAttribute()
    {
        if ($this->validated_at == null)
            return "pending";
        if (count($this->validation_errors) > 0)
            return "failed";
        return "success";
    }

    public static function isCorrectToken(Project|int $project, string $token) : bool
    {
        return self::token($project) === $token;
    }

    public static function token(Project|int $project) : string
    {
        return md5(strtolower($project instanceof Project ? $project->project_id : $project) . config('scalable.webhook_secret'));
    }

    public function progress() : int
    {
        return match ($this->task->correction_type)
        {
            CorrectionType::PointsRequired => $this->pointProgress(),
            default                        => $this->plainProgress()
        };
    }

    private function pointProgress() : int
    {
        $completed = $this->subTasks->pluck('sub_task_id');
        if ($completed->isEmpty())
            return 0;

        $maxPoints = $this->task->sub_tasks->maxPoints();
        $points = $this->task->sub_tasks->points($completed);

        return (int)(round($points / $maxPoints * 100));
    }

    private function plainProgress() : int
    {
        if ($this->status == ProjectStatus::Finished && $this->task->correction_type != CorrectionType::RequiredTasks)
            return 100;

        $subTasks = $this->task->sub_tasks;
        if ($subTasks->isEmpty())
            return 0;

        $completed = $this->subTasks()->count();

        return (int)(round($completed / $subTasks->count() * 100));
    }
}
