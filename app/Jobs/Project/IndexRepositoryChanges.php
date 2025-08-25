<?php

namespace App\Jobs\Project;

use App\Models\Enums\ProjectDiffIndexStatus;
use App\Models\Project;
use App\Models\ProjectDiffIndex;
use Clockwork\Request\Log;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Middleware\RateLimited;
use Illuminate\Queue\Middleware\WithoutOverlapping;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;

class IndexRepositoryChanges implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function middleware(): array
    {
        return [
            new WithoutOverlapping($this->project->id . '-' . $this->comparisonSha)->dontRelease(),
        ];
    }

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
        \Log::info("Indexing changes in project: ".$this->project->repo_name." (ID: ".$this->project->id.')');

        if ($this->project->task->getSha() == null)
        {
            $this->fail(new \Exception("Task has no sha and a comparison therefor can't be done."));

            return;
        }
        /** @var ProjectDiffIndex|null $index */
        $index = $this->project->changes()->where('from', $this->project->task->getSha())->where('to', $this->comparisonSha)->first();
        if($index != null && $index->status == ProjectDiffIndexStatus::Success) // don't reindex if already successful
        {\Log::info("A successful index of the changes is already created, aborting...");

            return;
        }

        $accessToken = config('sourcecontrol.users.default.token');
        $sourceControlProject = $this->project->sourceControl();
        $url = Str::of($sourceControlProject->cloneUrl)->replace('://', "://:$accessToken@");
        exec("docker run jazerix/git-diff:latest $url {$this->project->task->getSha()} $this->comparisonSha 2>&1", $output, $code);

        $index = $index == null ? new ProjectDiffIndex() : $index;
        $index->project_id = $this->project->id;
        $index->last_try = now();
        $index->from = $this->project->task->getSha();
        $index->to = $this->comparisonSha;
        if($code != 0)
        {
            $output = Str::of($output[0]);
            $index->status = ProjectDiffIndexStatus::Failure;
            $index->message = match (true)
            {
                $output->contains('docker') => "Docker: " . $output,
                default                     => "Unable to index: " . $output
            };
            $index->save();
            \Log::info("An error occurred while trying to index project: ".$this->project->repo_name." (ID: ".$this->project->id.')\nReason: '.$index->message);

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
        \Log::info("Indexing was successful in project: ".$this->project->id." (ID: ".$this->project->id.')');
    }
}
