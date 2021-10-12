<?php

namespace App\Http\Controllers;

use App\Models\JobStatus;
use App\Models\Project;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function builds(Project $project)
    {
        return $project->jobStatuses()->latest()->get()->makeHidden(['history', 'log'])->map(function(JobStatus $job) {
            $job->run_time = CarbonInterval::seconds($job->duration)->forHumans();
            $job->queued_for = CarbonInterval::seconds($job->queue_duration)->forHumans();
            $job->ran = $job->updated_at->diffForHumans();
            $job->ran_date =$job->updated_at->toDateTimeString();
            return $job;
        });
    }
}
