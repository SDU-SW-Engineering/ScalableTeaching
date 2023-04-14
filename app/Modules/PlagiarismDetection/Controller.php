<?php

namespace App\Modules\PlagiarismDetection;

use App\Http\Controllers\Controller as BaseController;
use App\Models\Course;
use App\Models\PlagiarismAnalysis;
use App\Models\PlagiarismAnalysisFileComparison;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Database\Eloquent\Builder;
use MathPHP\Probability\Distribution\Continuous\Normal;
use MathPHP\Statistics\Descriptive;

class Controller extends BaseController
{
    public function dashboard(Course $course, Task $task)
    {
        /** @var PlagiarismAnalysis $analysis */
        $analysis = $task->plagiarismAnalysis()->first();
        $names = $task->projects->mapWithKeys(fn(Project $project) => [$project->id => $project->owners()->pluck('name')->join(', ')]);
        $files = [];
        $comparisonTable = [];
        foreach($task->projects as $project) {
            $comparisonWithMostOverlap = $analysis->comparisons()->where('project_1_id', $project->id)->orWhere('project_2_id', $project->id)->orderBy('overlap', 'desc')->first();
            if($comparisonWithMostOverlap == null)
                continue;

            $relevantFiles = $analysis->fileComparisons()
                ->where(function(Builder $query) use ($comparisonWithMostOverlap) {
                    $query->where('project_1_id', $comparisonWithMostOverlap->project_1_id)
                        ->where('project_2_id', $comparisonWithMostOverlap->project_2_id);
                })->orWhere(function(Builder $query) use ($comparisonWithMostOverlap) {
                    $query->where('project_1_id', $comparisonWithMostOverlap->project_2_id)
                        ->where('project_2_id', $comparisonWithMostOverlap->project_1_id);
                })->get();
            $index = $relevantFiles[0]->project_1_id == $project->id ? 1 : 2;
            $comparedWithProjectId = $comparisonWithMostOverlap['project_' . ($index == 1 ? 2 : 1) . '_id'];
            $comparisonTable[$project->id] = [
                'name'          => $names[$project->id],
                'compared_with' => [
                    'project_id' => $comparedWithProjectId,
                    'name'       => $names[$comparedWithProjectId]
                ]
            ];
            foreach($relevantFiles as $file) {
                $fileName = $file["filename_$index"];
                if(!array_key_exists($fileName, $files))
                    $files[$fileName] = [];

                $files[$fileName][$project->id] = [
                    'file_overlap'  => $file['overlap'],
                    'total_overlap' => $comparisonWithMostOverlap->overlap,
                    'compared_with' => $names[$comparedWithProjectId]
                ];
            }
        }

        $scores = collect($files)->map(function($scores, $file) use ($names) {
            $data = collect($scores)->sortBy('total_overlap')->map(fn($score, $project) => [
                'x'  => $names[$project],
                'y'  => round($score['file_overlap'] * 100, 2),
                'id' => $project
            ])->values();

            return [
                'name' => $file,
                'data' => $data,
            ];
        })->values();
        $quantiles = collect($scores)->map(function($score) {
            $min = $score['data']->pluck('y')->min();
            $max = $score['data']->pluck('y')->max();
            $percentile25 = Descriptive::percentile($score['data']->pluck('y')->toArray(), 25);
            $percentile50 = Descriptive::percentile($score['data']->pluck('y')->toArray(), 50);
            $percentile75 = Descriptive::percentile($score['data']->pluck('y')->toArray(), 75);

            return [
                'x' => $score['name'],
                'y' => [$min, $percentile25, $percentile50, $percentile75, $max]
            ];
        });

        return view("module-PlagiarismDetection::pages.dashboard")
            ->with('scores', $scores)
            ->with('quantiles', $quantiles)
            ->with('comparisonTable', $comparisonTable);
    }
}
