<?php

namespace App\Modules\PlagiarismDetection;

use App\Http\Controllers\Controller as BaseController;
use App\Models\Course;
use App\Models\PlagiarismAnalysis;
use App\Models\PlagiarismAnalysisComparison;
use App\Models\PlagiarismAnalysisFileComparison;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Database\Eloquent\Builder;
use MathPHP\Statistics\Descriptive;
use function Pest\Laravel\options;

class Controller extends BaseController
{
    public function dashboard(Course $course, Task $task)
    {
        /** @var PlagiarismAnalysis $analysis */
        $analysis = $task->plagiarismAnalysis()->first();
        $names = $task->projects->mapWithKeys(fn(Project $project) => [$project->id => $project->owner_names]);
        $files = [];
        $similarities = $analysis->similarities()->keyBy(fn(Similarity $similarity) => $similarity->getProjectId());

        foreach($similarities as $similarity) {
            foreach($similarity->files() as $file) {
                $file = $file->perspective($similarity->getProjectId());
                $files[$file['file']][$similarity->getProjectId()] = [
                    'file_overlap'  => $file['overlap'],
                    'total_overlap' => $similarity->getOverlap(),
                    'compared_with' => $similarity->getProjectId()
                ];
            }
        }

        $scores = collect($files)->map(function($scores, $file) use ($names) {
            $data = collect($scores)->sortBy('total_overlap')->map(fn($score, $project) => [
                'x'  => "$project",
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
            ->with('similarities', $similarities)
            ->with('nameMap', $names)
            ->with('quantiles', $quantiles);
    }

    public function details(Course $course, Task $task, Project $project, int $overlapId = null)
    {
        /** @var PlagiarismAnalysis $analysis */
        $analysis = $task->plagiarismAnalysis()->first();
        //   dd($analysis->fileComparisonsByProject($project->id)->get());
        $overlaps = $analysis->comparisonsByProjectId($project->id)->orderBy('overlap', 'desc')->get();

        /** @var PlagiarismAnalysisComparison $selectOverlap */
        $selectOverlap = $overlapId == null ? $overlaps->first() : $overlaps->firstWhere('id', $overlapId);
        dd($selectOverlap->files()->get(), $selectOverlap->percentiles);
        return view("module-PlagiarismDetection::pages.details")->with('overlap', $selectOverlap);
    }
}
