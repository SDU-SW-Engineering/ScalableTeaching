<?php

namespace App\Jobs\Project;

use App\Models\Enums\ProjectDiffIndexStatus;
use App\Models\Project;
use App\Models\ProjectDiffIndex;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;

class IndexRepositoryChanges implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(public Project $project, public string $comparisonSha)
    {

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        /** @var ProjectDiffIndex|null $index */
        $index = $this->project->changes()->where('from', $this->project->task->current_sha)->where('to', $this->comparisonSha)->first();
        if($index != null && $index->status == ProjectDiffIndexStatus::Success)
            return;

        $accessToken = config('sourcecontrol.users.default.token');
        $sourceControlProject = $this->project->sourceControl();
        $url = Str::of($sourceControlProject->cloneUrl)->replace('://', "://:$accessToken@");
        exec("docker run jazerix/git-diff:latest $url {$this->project->task->current_sha} $this->comparisonSha 2>&1", $output, $code);

        $index = $index == null ? new ProjectDiffIndex() : $index;
        $index->project_id = $this->project->id;
        $index->last_try = now();
        $index->from = $this->project->task->current_sha;
        $index->to = $this->comparisonSha;
        if($code != 0)
        {
            $output = Str::of($output[0]);
            $index->status = ProjectDiffIndexStatus::Failure;
            $index->message = match (true)
            {
                $output->contains('docker') => "Docker: "  . $output,
                default                     => "Unable to index: " . $output
            };
            $index->save();

            return;
        }

        /** @var array{file: string, status: string, lines: int, proportion: string} $changes */
        $changes = [];
        foreach($output as $line)
        {
            $line = Str::of($line);
            if(preg_match("/(.*)\|.*(\d+)\s*([+-]+)/", $line, $matches) !== 1)
                continue;

            $fileInfo = $matches[1];
            preg_match('/(\S+)\s+(?:\((new|gone))?/', $fileInfo, $fileParts);
            $status = count($fileParts) == 3 ? $fileParts[2] : 'change';

            $changes[] = [
                'file'       => $fileParts[1],
                'status'     => $status,
                'lines'      => $matches[2],
                'proportion' => $matches[3],
            ];
        }

        $index->message = null;
        $index->changes = $changes;
        $index->status = ProjectDiffIndexStatus::Success;
        $index->save();
    }
}
