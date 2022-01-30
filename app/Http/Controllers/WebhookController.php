<?php

namespace App\Http\Controllers;

use App\Exceptions\Webhook\WebhookException;
use App\Models\JobStatus;
use App\Models\Project;
use Carbon\Carbon;

class WebhookController extends Controller
{
    public function reporter()
    {
        abort_unless(\request()->hasHeader('X-Gitlab-Token'), 400, 'No gitlab token supplied');
        throw_unless(request()->has('project_id'), WebhookException::class, )
        abort_unless(Project::isCorrectToken(request('project_id'), request()->header('X-Gitlab-Token')), 400, 'Token mismatch');

        $project = Project::firstWhere('project_id', request('project_id'));
        if ($project == null)
            return "ignored";

        if ($project->status == 'finished')
            return "finished";

        $startedAt = Carbon::parse(\request('build_created_at'))->setTimezone(config('app.timezone'));
        if ($startedAt->isAfter($project->task->ends_at))
        {
            \Log::info('A user submitted a task over the deadline', [
                'deadline'     => $project->task->ends_at,
                'submitted_at' => $startedAt,
                'request'      => request()->all()
            ]);
            return "overdue";
        }

        $jobStatus             = JobStatus::where([
            'build_id'   => request('build_id'),
            'project_id' => $project->id
        ])->firstOrNew();
        $jobStatus->build_id   = request('build_id');
        $jobStatus->project_id = $project->id;
        $jobStatus->status     = request('build_status');
        $jobStatus->user_name  = request('user.name');
        $jobStatus->user_email = request('user.email');
        if ($jobStatus->log == null)
            $jobStatus->log = [];
        if ($jobStatus->history == null)
            $jobStatus->history = [];
        if ($jobStatus->created_at == null)
            $jobStatus->created_at = $startedAt;
        $jobStatus->repo_branch = request('ref');
        $jobStatus->repo_name   = \request('repository.name');
        if (\request('build_duration') != null)
            $jobStatus->duration = \request('build_duration');
        if (\request('build_queued_duration') != null)
            $jobStatus->queue_duration = \request('build_queued_duration');
        if (\request('runner') != null)
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
        $jobStatus->log     = $logs;
        $jobStatus->history = $history;
        $jobStatus->save();

        if ($jobStatus->status == 'success')
            $project->update([
                'status'           => 'finished',
                'final_commit_sha' => request('sha'),
                'finished_at'      => now()
            ]);


        return response("ok", 200);
    }
}
