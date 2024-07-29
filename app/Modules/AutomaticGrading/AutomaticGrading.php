<?php

namespace App\Modules\AutomaticGrading;

use App\Jobs\Pipeline\RefreshPipeline;
use App\Models\Pipeline;
use App\Models\Project;
use App\Models\ProjectSubTask;
use App\Models\Task;
use App\Modules\BuildTracking\BuildTracking;
use App\Modules\MarkAsDone\MarkAsDone;
use App\Modules\Module;
use App\Modules\Settings;
use App\ProjectStatus;
use Illuminate\Support\Facades\Log;

class AutomaticGrading extends Module
{
    protected string $name = "Automatic Grading";

    protected string $icon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-lime-green-300">
  <path fill-rule="evenodd" d="M14.615 1.595a.75.75 0 01.359.852L12.982 9.75h7.268a.75.75 0 01.548 1.262l-10.5 11.25a.75.75 0 01-1.272-.71l1.992-7.302H3.75a.75.75 0 01-.548-1.262l10.5-11.25a.75.75 0 01.913-.143z" clip-rule="evenodd" />
</svg>
';
    protected string $description = "Tasks will be automatically graded (pass/failed) based on configuration.";
    protected array $dependencies = [BuildTracking::class];

    protected array $conflicts = [
        MarkAsDone::class,
    ];

    /**
     * @inheritDoc
     */
    protected function loadSettings(): ?Settings
    {
        return new AutomaticGradingSettings();
    }

    public function isEnabled(AutomaticGradingSettings|Settings|null $settings): bool
    {
        if ($settings instanceof AutomaticGradingSettings)
        {
            return $settings->gradingType != null;
        }

        return false;
    }

    public function update(Task $task): void
    {

        /** @var AutomaticGradingSettings $settings */
        $settings = $this->settings();
        Log::info("Updating task {$task->id} with automatic grading settings: {$settings->gradingType}");
        if ($settings->isPipelineBased())
        {
            $allProjectsForTask = $task->projects();
            $allProjectsForTask->each(function (Project $project, $index) {
                /** @var Pipeline|null $latestPipeline */
                $latestPipeline = $project->pipelines()->latest()->first();
                if ( ! $latestPipeline)
                {
                    Log::info("No pipeline found for project {$project->id}, setting status to active.");
                    $project->setProjectStatus(ProjectStatus::Active);

                    return;
                }

                // Queue jobs to refresh pipelines to avoid overloading the gitlab api.
                // We delay each job by 1 second. Since the projects endpoint can do 400 requests per minute. See https://docs.gitlab.com/ee/administration/settings/rate_limit_on_projects_api.html
                RefreshPipeline::dispatch($latestPipeline)->delay($index * 1);
            });
        } else
        {
            $task->projects()->each(function (Project $project) {
                $subTasksToRecreate = array_map(function($subTask) {
                    return new ProjectSubTask([
                        'sub_task_id' => $subTask['sub_task_id'],
                        'source_type' => $subTask['source_type'],
                        'source_id'   => $subTask['source_id'],
                        'points'      => $subTask['points'],
                    ]);
                }, $project->subTasks->toArray());
                if (count($subTasksToRecreate) > 0)
                {
                    $project->createSubTasks($subTasksToRecreate);
                }
            });
        }
    }


}
