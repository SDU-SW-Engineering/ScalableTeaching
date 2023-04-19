<?php

namespace App\Modules\PlagiarismDetection\Visualization;

use App\Models\Project;
use App\Models\Task;
use App\Modules\PlagiarismDetection\Similarity;
use Illuminate\Support\Collection;

class CytoscapeGraphConverter
{
    public static function network(Collection $similarities, Task $task): array
    {
        $names = $task->projects->mapWithKeys(fn(Project $project) => [$project->id => $project->owner_names]);
        $graphNodes = $similarities
            ->map(fn(Similarity $similarity) => [
                'data' => [
                    'id'   => $similarity->getProjectId(),
                    'name' => str($names[$similarity->getProjectId()])->shortName()
                ]
            ])->unique('data.id');
        $graphEdges = $similarities->map(fn(Similarity $similarity) => ['data' => [
            'id'      => "{$similarity->getProjectId()}-{$similarity->getComparedWithProjectId()}",
            'source'  => $similarity->getProjectId(),
            'target'  => $similarity->getComparedWithProjectId(),
            'overlap' => $similarity->getOverlap() * 100 . "%"
        ]])->values();
        return [...$graphEdges, ...$graphNodes];
    }
}
