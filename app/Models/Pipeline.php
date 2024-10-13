<?php

namespace App\Models;

use App\Exceptions\PipelineException;
use App\Models\Casts\SubTask;
use App\Models\Enums\PipelineStatusEnum;
use App\Modules\AutomaticGrading\AutomaticGrading;
use App\Modules\AutomaticGrading\AutomaticGradingSettings;
use App\ProjectStatus;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Database\Factories\PipelineFactory;
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
use Illuminate\Support\Facades\Log;
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
 * @method static PipelineFactory factory()
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
        'canceled'  => [PipelineStatusEnum::Success, PipelineStatusEnum::Failed, PipelineStatusEnum::Running],
        'pending'   => [PipelineStatusEnum::Running, PipelineStatusEnum::Failed, PipelineStatusEnum::Success, PipelineStatusEnum::Canceled],
        'failed'    => [PipelineStatusEnum::Success, PipelineStatusEnum::Failed],
        'success'   => [PipelineStatusEnum::Success, PipelineStatusEnum::Failed],
        'running'   => [PipelineStatusEnum::Failed, PipelineStatusEnum::Success, PipelineStatusEnum::Canceled],
    ];

    protected static function booted()
    {
        static::created(function (Pipeline $pipeline) {
            Pipeline::checkAutomaticGrading($pipeline);
        });
    }

    /**
     * @param Pipeline $pipeline
     * @return bool Whether or not this automatic grading check handled the project status.
     * @throws \Exception
     */
    private static function checkAutomaticGrading(Pipeline $pipeline): bool
    {
        Log::info("Checking automatic grading for pipeline {$pipeline->pipeline_id}");
        $automaticGradingModule = $pipeline->project->task->module_configuration->resolveModule(AutomaticGrading::class);
        if ($automaticGradingModule == null)
            return false;


        /** @var AutomaticGradingSettings $settings */
        $settings = $automaticGradingModule->settings();
        if ( ! $settings->isPipelineBased())
        {
            return false;
        }

        if ($pipeline->status != PipelineStatusEnum::Success)
        {
            Log::info("Pipeline {$pipeline->pipeline_id} is not successful, setting project {$pipeline->project_id} to active");
            $pipeline->project->setProjectStatusFor(ProjectStatus::Active, Pipeline::class, $pipeline->id);

            return true;
        }

        Log::info("Pipeline {$pipeline->pipeline_id} is successful, automatically grading project {$pipeline->project_id}");

        $pipeline->project->setProjectStatusFor(ProjectStatus::Finished, Pipeline::class, $pipeline->id);

        return true;
    }

    public function isUpgradable(PipelineStatusEnum $to): bool
    {
        if ( ! array_key_exists($this->status->value, static::$upgradable))
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
        Log::info("Processing pipeline {$this->pipeline_id} for project {$this->project_id}");
        throw_if(self::isOutsideTimeFrame($startedAt, $this->project), PipelineException::class, "Past deadline");
        if ( ! $this->isUpgradable($status))
            return;

        DB::transaction(function () use ($succeedingBuilds, $queueDuration, $duration, $status) {
            $this->update([
                'status'         => $status->value,
                'duration'       => $duration,
                'queue_duration' => $queueDuration,
            ]);
            $tracking = (new Collection($this->project->task->sub_tasks->all()))->mapWithKeys(fn(SubTask $task) => [strtolower($task->getName()) => $task]);

            /** @var (ProjectSubTask|null)[] $subTasksToCreate */
            $subTasksToCreate = array_map(function ($build) use ($tracking) {
                /** @var SubTask|null $subTask */
                $subTask = $tracking->get($build);

                if ( ! $subTask)
                {
                    Log::debug("Sub task {$build} not found in project {$this->project_id}");

                    return null;
                }

                return new ProjectSubTask([
                    'sub_task_id' => $subTask->getId(),
                    'source_type' => Pipeline::class,
                    'source_id'   => $this->id,
                    'points'      => $subTask->getPoints(),
                ]);
            }, $succeedingBuilds);

            /** @var ProjectSubTask[] $validSubTasksToCreate */
            $validSubTasksToCreate = array_filter($subTasksToCreate, function ($subTask) {
                return $subTask != null;
            });

            $this->project->createSubTasks($validSubTasksToCreate);
        });

        $gradeResult = Pipeline::checkAutomaticGrading($this);
        // Since some checks run on sub task creation, we have this clause here
        // to overwrite finished projects, if all jobs fail, but it requires all jobs or something along the lines.
        if ($gradeResult == false && count($succeedingBuilds) < 1)
        {
            $this->project->setProjectStatus(ProjectStatus::Active);
        }
    }

    /**
     * @throws Throwable
     */
    public function refreshPipeline(): void
    {
        Log::info("Refreshing pipeline {$this->pipeline_id} for project {$this->project_id}");
        $sourceControl = app(SourceControl::class);

        if($this->project == null) // project is deleted
        {
            Log::warning("Project {$this->project_id} is deleted, canceling pipeline {$this->pipeline_id}");
            $this->update(['status' => PipelineStatusEnum::Canceled]);

            return;
        }

        $pipeline = $sourceControl->getPipeline($this->project->gitlab_project_id, $this->pipeline_id);
        if($pipeline == null)
        {
            Log::error("Pipeline {$this->pipeline_id} for project {$this->project_id} does not exist");

            // pipeline no longer exists -> failed
            // TODO: Check if this should still contain update to Canceled status
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
