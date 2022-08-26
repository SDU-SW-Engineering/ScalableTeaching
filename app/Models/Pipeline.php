<?php

namespace App\Models;

use App\Models\Casts\SubTask;
use App\Models\Enums\CorrectionType;
use App\Models\Enums\PipelineStatusEnum;
use App\ProjectStatus;
use Carbon\CarbonInterval;
use GrahamCampbell\ResultType\Success;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public static $upgradable = [
        'pending' => [PipelineStatusEnum::Running, PipelineStatusEnum::Failed, PipelineStatusEnum::Success],
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

    public function scopeFinished(Builder $query)
    {
        $query->where('status', 'finished');
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function subTasks() : HasMany
    {
        return $this->hasMany(ProjectSubTask::class);
    }

    public function getPrettySubTasksAttribute()
    {
        $availableSubTasks = $this->project->task->sub_tasks;
        $completedSubTasks = $this->subTasks->pluck('sub_task_id');

        return $availableSubTasks->all()->map(fn(SubTask $subTask) => [
            'name'      => $subTask->getDisplayName(),
            'completed' => $completedSubTasks->contains($subTask->getId()),
        ]);
    }

    public function getRunTimeAttribute()
    {
        return CarbonInterval::seconds($this->duration)->forHumans();
    }

    public function getQueuedForAttribute()
    {
        return CarbonInterval::seconds($this->queue_duration)->forHumans();
    }
}
