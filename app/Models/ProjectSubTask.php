<?php

namespace App\Models;

use App\Models\Casts\SubTask;
use App\Models\Enums\CorrectionType;
use App\Models\Enums\PipelineStatusEnum;
use App\ProjectStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use InvalidArgumentException;

/**
 * @property Project $project
 */
class ProjectSubTask extends Model
{
    use HasFactory;

    protected $fillable = ['sub_task_id', 'pipeline_id'];

    protected static function booted()
    {
        static::created(function (ProjectSubTask $projectSubTask)
        {
            $project   = $projectSubTask->project;
            $completed = $project->subTasks->pluck('sub_task_id');
            /*$missing          = $requiredSubTasks->diff($completed);
            if ($requiredSubTasks->count() == 0)
                return;

            if ($missing->count() > 0)
                return;*/
            $isFinished = static::isFinished($project);

            if ($isFinished == false)
                return;

            $project->update([
                'status' => ProjectStatus::Finished
            ]);
        });
    }

    /**
     * @param Project $project
     * @param Task $task
     * @return bool
     * @throws \Exception
     */
    private static function isFinished(Project $project) : bool
    {
        $completedSubTasks = $project->subTasks->pluck('sub_task_id');
        $task              = $project->task;

        return match ($task->correction_type)
        {
            CorrectionType::None, CorrectionType::PipelineSuccess => false,
            CorrectionType::AllTasks                              => ! $task->sub_tasks->isMissingAny($completedSubTasks),
            CorrectionType::RequiredTasks                         => ! $task->sub_tasks->isMissingAnyRequired($completedSubTasks),
            CorrectionType::NumberOfTasks                         => $completedSubTasks->count() >= $task->correction_value,
            CorrectionType::PointsRequired                        => $task->sub_tasks->points($completedSubTasks) >= $task->correction_value
        };
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
