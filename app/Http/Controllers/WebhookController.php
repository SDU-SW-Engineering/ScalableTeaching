<?php

namespace App\Http\Controllers;

use App\Exceptions\Webhook\WebhookException;
use App\Models\Enums\PipelineStatusEnum;
use App\Models\Pipeline;
use App\Models\Project;
use App\WebhookTypes;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class WebhookController extends Controller
{
    /**
     * @throws \Throwable
     */
    public function reporter()
    {
        abort_unless(request()->hasHeader('X-Gitlab-Token'), 400, 'No GitLab token supplied');
        abort_unless(request()->hasHeader('X-GitLab-Event'), 400, 'GitLab event missing');
        abort_unless(request()->has('project_id') || request()->has('project.id'), 400, 'Project ID missing');
        abort_unless(Project::isCorrectToken(request('project_id', request('project.id')), request()->header('X-Gitlab-Token')), 400, 'Token mismatch');

        return match (WebhookTypes::tryFrom(request()->header('X-GitLab-Event'))) {
            WebhookTypes::Pipeline => $this->pipeline(),
            default => "ignored",
        };


        $project = Project::firstWhere('project_id', request('project_id'));
        if($project == null)
            return "ignored";

        if($project->status == 'finished')
            return "finished";

        $startedAt = Carbon::parse(\request('build_created_at'))->setTimezone(config('app.timezone'));
        if($startedAt->isAfter($project->task->ends_at)) {
            \Log::info('A user submitted a task over the deadline', [
                'deadline'     => $project->task->ends_at,
                'submitted_at' => $startedAt,
                'request'      => request()->all()
            ]);
            return "overdue";
        }

        $jobStatus = Pipeline::where([
            'build_id'   => request('build_id'),
            'project_id' => $project->id
        ])->firstOrNew();
        $jobStatus->build_id = request('build_id');
        $jobStatus->project_id = $project->id;
        $jobStatus->status = request('build_status');
        $jobStatus->user_name = request('user.name');
        $jobStatus->user_email = request('user.email');
        if($jobStatus->log == null)
            $jobStatus->log = [];
        if($jobStatus->history == null)
            $jobStatus->history = [];
        if($jobStatus->created_at == null)
            $jobStatus->created_at = $startedAt;
        $jobStatus->repo_branch = request('ref');
        $jobStatus->repo_name = \request('repository.name');
        if(\request('build_duration') != null)
            $jobStatus->duration = \request('build_duration');
        if(\request('build_queued_duration') != null)
            $jobStatus->queue_duration = \request('build_queued_duration');
        if(\request('runner') != null)
            $jobStatus->runner = \request('runner.description');

        $logs = collect($jobStatus->log);
        $logs->push(request()->toArray());
        $history = collect($jobStatus->history);

        $history->push([
            'status'      => \request('build_status'),
            'created_at'  => \request('build_created_at') == null ? null : Carbon::parse(\request('build_created_at')),
            'started_at'  => \request('build_started_at') == null ? null : Carbon::parse(\request('build_started_at')),
            'finished_at' => \request('build_finished_at') == null ? null : Carbon::parse(\request('build_finished_at')),
        ]);
        $jobStatus->log = $logs;
        $jobStatus->history = $history;
        $jobStatus->save();

        if($jobStatus->status == 'success')
            $project->update([
                'status'           => 'finished',
                'final_commit_sha' => request('sha'),
                'finished_at'      => now()
            ]);


        return response("ok", 200);
    }

    private function pipeline()
    {
        $project = Project::firstWhere('project_id', request('project.id'));
        $pipeline = $project->pipelines()->firstWhere('pipeline_id', request('object_attributes.id'));
        if($pipeline != null && !$pipeline->isUpgradable(PipelineStatusEnum::tryFrom(request('object_attributes.status'))))
            return "OK";

        if($pipeline == null)
            $pipeline = $this->createPipeline($project);
        else
            $pipeline->update([
                'status'         => request('object_attributes.status'),
                'duration'       => request('object_attributes.duration') ?? null,
                'queue_duration' => request('object_attributes.queued_duration') ?? null,
            ]);

        $tracking = collect($project->task->sub_tasks)->pluck('test_name', 'id');
        $builds = collect(request('builds'));
        $succeedingBuilds = $builds->filter(fn($build) => $tracking->contains($build['name']) && $build['status'] == 'success');
        $succeedingBuilds->each(fn($build) => $project->subTasks()->firstOrCreate([
            'sub_task_id' => $tracking->flip()->get($build['name']),
            'pipeline_id' => $pipeline->id
        ]));

        return "OK";
    }

    /**
     * @param Project $project
     * @return Pipeline
     */
    private function createPipeline(Project $project): Pipeline
    {
        return $project->pipelines()->create([
            'pipeline_id'    => request('object_attributes.id'),
            'status'         => request('object_attributes.status'),
            'user_name'      => request('user.username'),
            'duration'       => request('object_attributes.duration') ?? null,
            'queue_duration' => request('object_attributes.queued_duration') ?? null,
            'created_at'     => Carbon::parse(request('object_attributes.created_at'))->setTimezone(config('app.timezone'))
        ]);
    }
}
