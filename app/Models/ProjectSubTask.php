<?php

namespace App\Models;

use App\Models\Casts\SubTask;
use App\Models\Enums\CorrectionType;
use App\Models\Enums\PipelineStatusEnum;
use App\ProjectStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use InvalidArgumentException;

/**
 * @property Project $project
 */
class ProjectSubTask extends Model
{
    use HasFactory;

    protected $fillable = ['sub_task_id', 'source_id', 'source_type', 'points'];

    protected static function booted()
    {
        static::created(function (ProjectSubTask $projectSubTask) {
            $project = $projectSubTask->project;
            $isFinished = static::isFinished($project);

            if ($isFinished == false)
                return;

            $project->setProjectStatus(ProjectStatus::Finished);
        });
    }

    /**
     * @param Project $project
     * @return bool
     * @throws \Exception
     */
    protected static function isFinished(Project $project) : bool
    {
        $completedSubTasks = $project->subTasks->pluck('sub_task_id');
        $task = $project->task;

        return match ($task->correction_type)
        {
            CorrectionType::AllTasks                              => ! $task->sub_tasks->isMissingAny($completedSubTasks),
            CorrectionType::RequiredTasks                         => ! $task->sub_tasks->isMissingAnyRequired($completedSubTasks),
            CorrectionType::NumberOfTasks                         => $completedSubTasks->count() >= $task->correction_tasks_required,
            CorrectionType::PointsRequired                        => $task->sub_tasks->points($completedSubTasks) >= $task->correction_points_required,
            default                                               => false
        };
    }

    /**
     * @return BelongsTo<Project,ProjectSubTask>
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
