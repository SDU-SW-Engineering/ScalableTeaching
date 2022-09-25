<?php

namespace App\Http\Controllers;

use App\Models\Casts\SubTask;
use App\Models\Enums\PipelineStatusEnum;
use App\Models\Pipeline;
use App\Models\Project;
use App\ProjectStatus;
use App\WebhookTypes;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class WebhookController extends Controller
{
    /**
     * @throws \Throwable
     */
    public function reporter(): WebhookTypes|string
    {
        abort_unless(request()->hasHeader('X-Gitlab-Token'), 400, 'No GitLab token supplied');
        abort_unless(request()->hasHeader('X-GitLab-Event'), 400, 'GitLab event missing');
        abort_unless(request()->has('project_id') || request()->has('project.id'), 400, 'Project ID missing');
        abort_unless(Project::isCorrectToken(request('project_id', request('project.id')), request()->header('X-Gitlab-Token')), 400, 'Token mismatch');

        return match (WebhookTypes::tryFrom(request()->header('X-GitLab-Event'))) {
            WebhookTypes::Pipeline => $this->pipeline(),
            WebhookTypes::Push => $this->push(),
            default => "ignored",
        };
    }

    private function pipeline(): string
    {
        /** @var Project|null $project */
        $project = Project::firstWhere('project_id', request('project.id'));
        if($project->status == ProjectStatus::Finished)
            return "OK";
        $startedAt = Carbon::parse(\request('object_attributes.created_at'))->setTimezone(config('app.timezone'));
        abort_if($startedAt->isAfter($project->task->ends_at) || $startedAt->isBefore($project->task->starts_at), 400, 'Pipeline could not be processed as it is overdue.');

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

        $tracking = (new Collection($project->task->sub_tasks->all()))->mapWithKeys(fn(SubTask $task) => [$task->getId() => $task->getName()]);
        $builds = new Collection(request('builds'));
        $succeedingBuilds = $builds->filter(fn($build) => $tracking->contains($build['name']) && $build['status'] == 'success');
        $project->subTasks()->delete();
        $succeedingBuilds->each(fn($build) => $project->subTasks()->firstOrCreate([
            'sub_task_id' => $tracking->flip()->get($build['name']),
            'source_type' => Pipeline::class,
            'source_id'   => $pipeline->id,
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
            'sha'            => request('object_attributes.sha') ?? null,
            'user_name'      => request('user.username'),
            'duration'       => request('object_attributes.duration') ?? null,
            'queue_duration' => request('object_attributes.queued_duration') ?? null,
            'created_at'     => Carbon::parse(request('object_attributes.created_at'))->setTimezone(config('app.timezone')),
        ]);
    }

    private function push(): string
    {
        /** @var Project $project */
        $project = Project::firstWhere('project_id', request('project.id'));
        abort_if($project == null, 404);
        $project->pushes()->create([
            'before_sha' => request('before'),
            'after_sha'  => request('after'),
            'ref'        => request('ref'),
            'username'   => request('user_username'),
            // todo: use the created at from the push request and not application timestamp
        ]);

        return "OK";
    }
}
