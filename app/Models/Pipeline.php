<?php

namespace App\Models;

use App\Exceptions\PipelineException;
use App\Models\Casts\SubTask;
use App\Models\Enums\CorrectionType;
use App\Models\Enums\PipelineStatusEnum;
use App\ProjectStatus;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Domain\SourceControl\Job;
use Domain\SourceControl\SourceControl;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Throwable;

/**
 * App\Models\JobStatus
 *
 * @property int $id
 * @property int $build_id
 * @property int $project_id
 * @property int $pipeline_id
 * @property PipelineStatusEnum $status
 * @property Project $project
 * @property string $repo_name
 * @property string $repo_branch
 * @property string|null $runner
 * @property string|null $duration
 * @property string|null $queue_duration
 * @property array $history
 * @property array $log
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @mixin \Eloquent
 * @property string $user_name
 * @property-read Collection<int,array{name:string,completed:bool}> $pretty_sub_tasks
 * @method static \Illuminate\Database\Eloquent\Builder|Pipeline whereUserEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pipeline whereUserName($value)
 */
class Pipeline extends Model
{
    use HasFactory;

    protected $fillable = ['project_id', 'pipeline_id', 'status', 'sha', 'user_name', 'runners', 'duration', 'queue_duration', 'created_at'];

    protected $casts = [
        'status'  => PipelineStatusEnum::class,
        'runners' => 'json',
    ];

    /**
     * @var array<string,array<int,PipelineStatusEnum>>
     */
    public static array $upgradable = [
        'pending' => [PipelineStatusEnum::Running, PipelineStatusEnum::Failed, PipelineStatusEnum::Success, PipelineStatusEnum::Canceled],
        'failed'  => [PipelineStatusEnum::Success, PipelineStatusEnum::Failed],
        'success' => [PipelineStatusEnum::Success, PipelineStatusEnum::Failed],
        'running' => [PipelineStatusEnum::Failed, PipelineStatusEnum::Success, PipelineStatusEnum::Canceled],
    ];

    protected static function booted()
    {
        static::created(function(Pipeline $pipeline) {
            if($pipeline->project->task->correction_type != CorrectionType::PipelineSuccess)
                return;

            if($pipeline->status != PipelineStatusEnum::Success)
                return;

            $pipeline->project->update([
                'status' => ProjectStatus::Finished,
            ]);
        });
    }

    public function isUpgradable(PipelineStatusEnum $to): bool
    {
        if( ! array_key_exists($this->status->value, static::$upgradable))
            return false;

        return in_array($to, static::$upgradable[$this->status->value]);
    }

    public static function isOutsideTimeFrame(Carbon $startedAt, Project $project): bool
    {
        return $startedAt->isAfter($project->task->ends_at) || $startedAt->isBefore($project->task->starts_at);
    }

    /**
     * @param Carbon $startedAt At which time the pipeline was started, this is relevant as we don't care about those that are after the deadline
     * @param PipelineStatusEnum $status The status of the pipeline
     * @param float|null $duration How long it took for the pipeline to finish
     * @param float|null $queueDuration How long the pipeline was queue for
     * @param array $succeedingBuilds The list of builds that have succeeded
     * @return void
     * @throws Throwable
     */
    public function process(Carbon $startedAt, PipelineStatusEnum $status, float $duration = null, float $queueDuration = null, array $succeedingBuilds = [])
    {
        throw_if(self::isOutsideTimeFrame($startedAt, $this->project), PipelineException::class, "Past deadline");
        if( ! $this->isUpgradable($status))
            return;

        DB::transaction(function() use ($succeedingBuilds, $queueDuration, $duration, $status) {
            $this->update([
                'status'         => $status->value,
                'duration'       => $duration,
                'queue_duration' => $queueDuration,
            ]);
            $tracking = (new Collection($this->project->task->sub_tasks->all()))->mapWithKeys(fn(SubTask $task) => [$task->getName() => $task]);
            $this->project->subTasks()->delete(); // reset subtasks
            (new Collection($succeedingBuilds))->each(function($build) use ($tracking) {
                /** @var SubTask $subTask */
                $subTask = $tracking->get($build);
                $this->project->subTasks()->firstOrCreate([
                    'sub_task_id' => $subTask->getId(),
                    'source_type' => Pipeline::class,
                    'source_id'   => $this->id,
                    'points'      => $subTask->getPoints(),
                ]);
            });
        });
    }

    /**
     * @throws Throwable
     */
    public function refreshPipeline(): void
    {
        $sourceControl = app(SourceControl::class);
        if($this->project == null) // project is deleted
        {
            $this->update(['status' => PipelineStatusEnum::Canceled]);

            return;
        }
        $pipeline = $sourceControl->getPipeline($this->project->gitlab_project_id, $this->pipeline_id);
        if($pipeline == null || $this->project->status == ProjectStatus::Finished)
        {
            // pipeline no longer exists -> failed
            $this->update(['status' => PipelineStatusEnum::Canceled]);

            return;
        }
        $jobs = $sourceControl->getPipelineJobs($this->project->gitlab_project_id, $this->pipeline_id);
        $tracking = (new Collection($this->project->task->sub_tasks->all()))->mapWithKeys(fn(SubTask $task) => [$task->getId() => $task->getName()]);
        $succeedingBuilds = array_filter($jobs, fn(Job $job) => $tracking->contains($job->name) && $job->status == 'success');
        $this->process(
            startedAt: Carbon::parse($pipeline->createdAt)->setTimezone(config('app.timezone')),
            status: PipelineStatusEnum::tryFrom($pipeline->status),
            duration: $pipeline->duration,
            queueDuration: $pipeline->queueDuration,
            succeedingBuilds: array_column($succeedingBuilds, 'name')
        );
    }

    /**
     * @param Builder<Pipeline> $query
     * @return Builder<Pipeline>
     */
    public function scopeFinished(Builder $query): Builder
    {
        return $query->where('status', 'finished');
    }

    /**
     * @param Builder<Pipeline> $query
     * @return Builder<Pipeline>
     */
    public function scopeStale(Builder $query): Builder
    {
        return $query->whereIn('status', [PipelineStatusEnum::Running, PipelineStatusEnum::Pending])->where('created_at', '<', now()->subHours(2));
    }

    /**
     * @return BelongsTo<Project,Pipeline>
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * @return MorphMany<ProjectSubTask>
     */
    public function subTasks(): MorphMany
    {
        return $this->morphMany(ProjectSubTask::class, 'source');
    }

    /**
     * @return Attribute<Collection<int,array{name:string,completed:bool}>,null>
     */
    public function prettySubTasks(): Attribute
    {
        return Attribute::make(get: function($value, $attributes) {
            $availableSubTasks = $this->project->task->sub_tasks;
            $completedSubTasks = $this->subTasks->pluck('sub_task_id');

            return $availableSubTasks->all()->map(fn(SubTask $subTask) => [
                'name'      => $subTask->getDisplayName(),
                'completed' => $completedSubTasks->contains($subTask->getId()),
            ]);
        });
    }

    /**
     * @return Attribute<string,null>
     */
    public function runTime(): Attribute
    {
        return Attribute::make(get: fn($value, $attributes) => CarbonInterval::seconds($attributes['duration'])->forHumans());
    }

    /**
     * @return Attribute<string,null>
     */
    public function queuedFor(): Attribute
    {
        return Attribute::make(get: fn($value, $attributes) => CarbonInterval::seconds($attributes['queue_duration'])->forHumans());
    }
}
