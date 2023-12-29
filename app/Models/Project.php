<?php

namespace App\Models;

use App\Events\ProjectCreated;
use App\Models\Casts\SubTask;
use App\Models\Enums\CorrectionType;
use App\Models\Enums\TaskDelegationType;
use App\ProjectStatus;
use App\Tasks\Validation\ProtectedFilesUntouched;
use Carbon\Carbon;
use Domain\GitLab\Definitions\Build;
use Domain\SourceControl\SourceControl;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

/**
 * App\Models\Project
 *
 * @property int $id
 * @property int|null $gitlab_project_id
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
 * @property int|null $ownable_id
 * @property string|null $ownable_type
 * @method static Builder|Project whereOwnableId($value)
 * @method static Builder|Project whereOwnableType($value)
 * @property-read User|Group $ownable
 * @property int $verified
 * @property string|null $final_commit_sha
 * @property \Illuminate\Support\Carbon|null $finished_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read string $duration
 * @property-read Task $task
 * @method static \Illuminate\Database\Query\Builder|Project onlyTrashed()
 * @method static Builder|Project whereDeletedAt($value)
 * @method static Builder|Project whereFinalCommitSha($value)
 * @method static Builder|Project whereFinishedAt($value)
 * @method static Builder|Project whereVerified($value)
 * @method static \Illuminate\Database\Query\Builder|Project withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Project withoutTrashed()
 * @property Grade $grade
 * @property-read bool $isMissed
 * @property Collection<int,string> $validation_errors
 * @property Carbon $validated_at
 * @property EloquentCollection<ProjectSubTask> $subTasks
 * @property EloquentCollection<ProjectSubTaskComment> $subTaskComments
 * @property-read string $ownerNames
 */
class Project extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['finished_at'];

    protected $casts = [
        'validation_errors' => 'collection',
        'status'            => ProjectStatus::class,
        'validated_at'      => 'datetime',
    ];

    protected $hidden = ['final_commit_sha'];

    protected $fillable = [
        'project_id', 'task_id', 'repo_name', 'status', 'ownable_type', 'ownable_id',
        'final_commit_sha', 'created_at', 'finished_at', 'validation_errors', 'validated_at', 'hook_id',
    ];

    protected $dispatchesEvents = [
        'created' => ProjectCreated::class,
    ];

    /**
     * @return MorphTo<Model,Project>
     */
    public function ownable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * @return HasMany<Pipeline>
     */
    public function pipelines(): HasMany
    {
        return $this->hasMany(Pipeline::class);
    }

    /**
     * @return HasMany<ProjectPush>
     */
    public function pushes(): HasMany
    {
        return $this->hasMany(ProjectPush::class);
    }

    /**
     * @return BelongsTo<Task,Project>
     */
    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }

    /**
     * @return HasMany<ProjectSubTask>
     */
    public function subTasks(): HasMany
    {
        return $this->hasMany(ProjectSubTask::class);
    }

    /**
     * @return HasMany<ProjectSubTaskComment>
     */
    public function subTaskComments(): HasMany
    {
        return $this->hasMany(ProjectSubTaskComment::class);
    }

    /**
     * @return HasOne
     */
    public function download(): HasOne
    {
        return $this->hasOne(ProjectDownload::class);
    }

    /**
     * @return HasMany<ProjectFeedback>
     */
    public function feedback(): HasMany
    {
        return $this->hasMany(ProjectFeedback::class);
    }

    /**
     * @return HasMany<ProjectDiffIndex>
     */
    public function changes(): HasMany
    {
        return $this->hasMany(ProjectDiffIndex::class);
    }

    /**
     * @param Builder<Project> $query
     * @return Builder<Project>
     */
    public function scopeEnded(Builder $query): Builder
    {
        return $query->whereIn('status', [ProjectStatus::Overdue, ProjectStatus::Finished]);
    }

    /**
     * @param Builder<Project> $query
     * @return Builder<Project>
     */
    public function scopeUnclaimed(Builder $query): Builder
    {
        return $query->whereNull('ownable_id');
    }

    public function scopeClaimed(Builder $query): Builder
    {
        return $query->whereNotNull('ownable_id');
    }

    /**
     * returns a collection of users that own the project
     * @return EloquentCollection<int,User>
     */
    public function owners(): EloquentCollection
    {
        if($this->ownable_type == User::class)
            // @phpstan-ignore-next-line
            return EloquentCollection::wrap([$this->ownable]);

        return $this->ownable->members ?? new EloquentCollection();
    }

    /**
     * @return Attribute<null|string,null>
     */
    public function duration(): Attribute
    {
        return Attribute::make(fn($value, $attributes) => $this->finished_at == null ? null : number_format($this->created_at->diffInHours($this->finished_at) / 24, 2));
    }

    /**
     * @param bool $withToday
     * @return Collection<int|string,int>
     */
    public function dailyBuilds(bool $withToday = false): Collection
    {
        return $this->pipelines()->daily($this->task->starts_at->startOfDay(), $this->task->earliestEndDate( ! $withToday))->get();
    }

    public function ownerNames(): Attribute
    {
        return Attribute::make(get: fn() => $this->owners()->pluck('name')->join(', '));
    }

    /**
     * @return Attribute<string,null>
     */
    public function validationStatus(): Attribute
    {
        return Attribute::make(get: function($value, $attributes) {
            if($this->validated_at == null)
                return "pending";
            if(count($this->validation_errors) > 0)
                return "failed";

            return "success";
        });
    }

    public static function isCorrectToken(Project|int $project, string $token): bool
    {
        return self::token($project) === $token;
    }

    public static function token(Project|int $project): string
    {
        return md5(strtolower($project instanceof Project ? "$project->gitlab_project_id" : $project) . config('scalable.webhook_secret'));
    }

    public function progress(): int
    {
        return match ($this->task->correction_type)
        {
            CorrectionType::PointsRequired => $this->pointProgress(),
            default                        => $this->plainProgress()
        };
    }

    private function pointProgress(): int
    {
        $completed = $this->subTasks->pluck('sub_task_id');
        if($completed->isEmpty())
            return 0;

        $maxPoints = $this->task->sub_tasks->maxPoints();
        $points = $this->task->sub_tasks->points($completed);

        return (int)(round($points / $maxPoints * 100));
    }

    private function plainProgress(): int
    {
        if($this->status == ProjectStatus::Finished && ! in_array($this->task->correction_type, [CorrectionType::RequiredTasks, CorrectionType::Manual]))
            return 100;

        $subTasks = $this->task->sub_tasks;
        if($subTasks->isEmpty())
            return 0;

        $completed = $this->subTasks()->count();

        return (int)(round($completed / $subTasks->count() * 100));
    }

    /**
     * @return Attribute<bool,null>
     */
    public function isMissed(): Attribute
    {
        return Attribute::make(get: function($value, $attributes) {
            if( ! $this->task->hasEnded)
                return false;
            if(in_array($this->task->correction_type, [CorrectionType::None, CorrectionType::Manual]))
                return $this->pushes()->where('created_at', '<', $this->task->ends_at)->count() == 0;

            return $this->status == ProjectStatus::Overdue;
        });
    }

    public function latestDownload(): null|ProjectDownload
    {
        /** @var ProjectPush | null $latestPush */
        $latestPush = $this->pushes()
            ->where('created_at', '<=', $this->task->ends_at)->latest()->first();

        return $latestPush?->download();
    }

    public function setProjectStatusFor(ProjectStatus $status, string $ownableType, int $ownableId, ?array $gradeMeta = [], Carbon $startedAt = null, Carbon $endedAt = null): void
    {
        $this->update([
            'status' => $status,
            ...$status == ProjectStatus::Finished ? ['finished_at' => now()] : [],
        ]);
        $this->owners()->each(/**
         * @throws Exception
         */ fn(User $user) => Grade::create([
            'task_id'     => $this->task_id,
            'source_type' => $ownableType,
            'source_id'   => $ownableId,
            'user_id'     => $user->id,
            'value'       => match ($status)
            {
                ProjectStatus::Overdue  => 'failed',
                ProjectStatus::Finished => 'passed',
                default                 => throw new Exception("Passes status must be a final value.")
            },
            'value_raw'   => $gradeMeta,
            'started_at'  => $startedAt,
            'ended_at'    => $endedAt,
        ]));
    }

    /**
     * @throws Exception
     */
    public function setProjectStatus(ProjectStatus $status): void
    {
        $this->setProjectStatusFor($status, Project::class, $this->id, null);
    }

    /**
     * @return \Domain\SourceControl\Project
     */
    public function sourceControl(): \Domain\SourceControl\Project
    {
        $sourceControl = app(SourceControl::class);

        return $sourceControl->showProject((string)$this->gitlab_project_id);
    }

    public function validateSubmission(): bool
    {
        $this->validated_at = now();
        $rules = [new ProtectedFilesUntouched()];
        foreach($rules as $rule)
        {
            $errors = $rule->validate($this->task, $this);
            if($errors->isEmpty())
                continue;

            $this->validation_errors = $errors;
            $this->save();

            return false;
        }

        $this->validation_errors = new Collection();
        $this->save();

        return true;
    }

    public function claim(User|Group $owner): Project
    {
        $this->update([
            'ownable_id'   => $owner->id,
            'ownable_type' => $owner::class,
        ]);

        return $this;
    }

    /**
     * Returns all pushes that have been made within the deadline of the project with a valid sha.
     * @return HasMany<ProjectPush> a list of pushes in descending order
     */
    public function relevantPushes() : HasMany
    {
        return $this
            ->pushes()
            ->isAccepted($this->task)
            ->isValid()
            ->latest();
    }
}
