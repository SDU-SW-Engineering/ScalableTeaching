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

        $scores = ApexChartConverter::heatMap($analysis, true);
        $similarities = $analysis->similarities()->keyBy(fn(Similarity $similarity) => $similarity->getProjectId());

        $quartiles = ApexChartConverter::percentiles($analysis, true);

        return view("module-PlagiarismDetection::pages.dashboard")
            ->with('scores', $scores)
            ->with('similarities', $similarities)
            ->with('nameMap', $names)
            ->with('quartiles', $quartiles);
    }

    public function details(Course $course, Task $task, Project $project, int $overlapId = null)
    {
        /** @var PlagiarismAnalysis $analysis */
        $analysis = $task->plagiarismAnalysis()->first();
        $overlaps = $analysis->comparisonsByProjectId($project->id)->orderBy('overlap', 'desc')->get();
        /** @var PlagiarismAnalysisComparison $selectOverlap */
        $selectOverlap = $overlapId == null ? $overlaps->first() : $overlaps->firstWhere('id', $overlapId);

        $hiddenFiles = $analysis->hiddenFiles()->pluck('filename');
        $userPlots = $selectOverlap->files()->get()
            ->reject(fn(PlagiarismAnalysisFileComparison $file) => $hiddenFiles->contains($file->perspective($project->id)->getFile()))
            ->map(function(PlagiarismAnalysisFileComparison $file) use ($project) {
                $overlapFileDetails = $file->perspective($project->id);
                return [
                    'x' => $overlapFileDetails->getFile(),
                    'y' => round($overlapFileDetails->getOverlap() * 100)
                ];
            })->values();
        $userFiles = $userPlots->pluck('x');
        $quartiles = ApexChartConverter::percentiles($analysis)->filter(fn($filePercentiles) => $userFiles->contains($filePercentiles['x']))->values();

        return view("module-PlagiarismDetection::pages.details")
            ->with('project', $project)
            ->with('overlap', $selectOverlap)
            ->with('quartiles', $quartiles)
            ->with('userPlots', $userPlots);
    }

    public function files(Course $course, Task $task)
    {
        /** @var PlagiarismAnalysis $analysis */
        $analysis = $task->plagiarismAnalysis()->first();
        $hiddenFiles = $analysis->hiddenFiles()->pluck('filename');

        return view('module-PlagiarismDetection::pages.files')->with('files', $analysis->filePercentiles()->sortKeys())
            ->with('hiddenFiles', $hiddenFiles);
    }

    public function hideFiles(Course $course, Task $task)
    {
        /** @var PlagiarismAnalysis $analysis */
        $analysis = $task->plagiarismAnalysis()->first();
        $analysis->hiddenFiles()->delete();
        $analysis->hiddenFiles()->createMany(('hide') == null ? [] : request()->collect('hide')->map(fn($checked, $file) => ['filename' => $file])->values());

        return redirect()->back();
    }

}
