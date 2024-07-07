<?php

namespace App\Models;

use App\Models\Enums\CorrectionType;
use App\Modules\AutomaticGrading\AutomaticGrading;
use App\Modules\AutomaticGrading\AutomaticGradingSettings;
use App\Modules\AutomaticGrading\AutomaticGradingType;
use App\ProjectStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Log;

/**
 * @property Project $project
 */
class ProjectSubTask extends Model
{
    use HasFactory;

    protected $fillable = ['sub_task_id', 'source_id', 'source_type', 'points'];

    protected static function booted()
    {
        static::created(function(ProjectSubTask $projectSubTask) {
            $automaticGradingModule = $projectSubTask->project->task->module_configuration->resolveModule(AutomaticGrading::class);
            if ($automaticGradingModule == null)
                return;

            /** @var AutomaticGradingSettings $settings */
            $settings = $automaticGradingModule->settings();
            if ($settings->isPipelineBased())
            {
                // This case will be handled in the pipeline itself. See Pipeline#checkAutomaticGrading
                return;
            }

            $project = $projectSubTask->project;
            ProjectSubTask::checkAutomaticGrading($project, $settings->getGradingType());

            // Re-enable once validation is based on module installation.
            //if( ! $project->validateSubmission())
            //    return;


        });
    }

    private static function checkAutomaticGrading(Project $project, AutomaticGradingType $gradingType)
    {

        $isValid = match ($gradingType)
        {
            AutomaticGradingType::ALL_SUBTASKS      => ProjectSubTask::validateAllSubtasks($project),
            AutomaticGradingType::REQUIRED_SUBTASKS => ProjectSubTask::validateRequiredSubtasks($project),
            default                                 => false
        };

        if ($isValid)
            $project->setProjectStatus(ProjectStatus::Finished);
        else
            $project->setProjectStatus(ProjectStatus::Active);
    }

    private static function validateAllSubtasks(Project $project): bool
    {
        Log::info("Validating project {$project->id} for all subtasks completed");
        $completedSubTasks = $project->subTasks->pluck('sub_task_id');
        $task = $project->task;
        $isValid = ! $task->sub_tasks->isMissingAny($completedSubTasks);

        if ( ! $isValid)
        {
            Log::info("Project {$project->id} is not valid for all subtasks completed");
        }

        return $isValid;
    }

    private static function validateRequiredSubtasks(Project $project): bool
    {
        Log::info("Validating project {$project->id} for all subtasks completed");
        $completedSubTasks = $project->subTasks->pluck('sub_task_id');

        $isValid = ! $project->task->isMissingRequiredSubtasks($completedSubTasks);

        if ( ! $isValid)
        {
            Log::info("Project {$project->id} is not valid for all subtasks completed");
        }

        return $isValid;
    }

    /**
     * @param Project $project
     * @return bool
     * @throws \Exception
     * @deprecated Kept around to cover all the same cases, but will be removed after they have all been converted to AutomaticGrading module settings.
     */
    protected static function isFinished(Project $project): bool
    {
        $completedSubTasks = $project->subTasks->pluck('sub_task_id');
        $task = $project->task;

        return match ($task->correction_type)
        {
            CorrectionType::AllTasks       => ! $task->sub_tasks->isMissingAny($completedSubTasks),
            CorrectionType::RequiredTasks  => ! $task->sub_tasks->isMissingAnyRequired($completedSubTasks),
            CorrectionType::NumberOfTasks  => $completedSubTasks->count() >= $task->correction_tasks_required,
            CorrectionType::PointsRequired => $task->sub_tasks->points($completedSubTasks) >= $task->correction_points_required,
            default                        => false
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
