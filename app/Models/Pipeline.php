<?php

namespace App\Models;

use App\Models\Casts\SubTask;
use App\Models\Enums\CorrectionType;
use App\Models\Enums\PipelineStatusEnum;
use App\ProjectStatus;
use Carbon\CarbonInterval;
use GrahamCampbell\ResultType\Success;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Collection;

/**
 * App\Models\JobStatus
 *
 * @property int $id
 * @property int $build_id
 * @property int $project_id
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

    protected $fillable = ['project_id', 'pipeline_id', 'status', 'user_name', 'runners', 'duration', 'queue_duration', 'created_at'];

    protected $casts = [
        'status'  => PipelineStatusEnum::class,
        'runners' => 'json',
    ];

    /**
     * @var array<string,array<int,PipelineStatusEnum>>
     */
    public static array $upgradable = [
        'pending' => [PipelineStatusEnum::Running, PipelineStatusEnum::Failed, PipelineStatusEnum::Success],
        'failed'  => [PipelineStatusEnum::Success, PipelineStatusEnum::Failed],
        'success' => [PipelineStatusEnum::Success, PipelineStatusEnum::Failed],
        'running' => [PipelineStatusEnum::Failed, PipelineStatusEnum::Success],
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
        if(!array_key_exists($this->status->value, static::$upgradable))
            return false;

        return in_array($to, static::$upgradable[$this->status->value]);
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
