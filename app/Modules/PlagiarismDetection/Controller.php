<?php

namespace App\Modules\PlagiarismDetection;

use App\Http\Controllers\Controller as BaseController;
use App\Models\Course;
use App\Models\PlagiarismAnalysis;
use App\Models\PlagiarismAnalysisComparison;
use App\Models\PlagiarismAnalysisFileComparison;
use App\Models\PlagiarismHiddenFile;
use App\Models\Project;
use App\Models\ProjectDownload;
use App\Models\Task;
use App\Modules\PlagiarismDetection\Visualization\ApexChartConverter;
use App\Modules\PlagiarismDetection\Visualization\CytoscapeGraphConverter;
use Domain\Files\Highlight;
use Illuminate\Support\Collection;
use MathPHP\Probability\Distribution\Continuous\Normal;
use MathPHP\Statistics\Descriptive;

class Controller extends BaseController
{
    public function dashboard(Course $course, Task $task)
    {
        /** @var PlagiarismAnalysis $analysis */
        $analysis = $task->plagiarismAnalysis()->first();
        $names = $task->projects->mapWithKeys(fn(Project $project) => [$project->id => $project->owner_names]);
        $scores = ApexChartConverter::heatMap($analysis, true);
        $similarities = $analysis->similarities()->keyBy(fn(Similarity $similar) => $similar->getProjectId());
        $hiddenFiles = PlagiarismHiddenFile::pluck('filename');
        $quartiles = ApexChartConverter::percentiles($analysis, true);
        $network = CytoscapeGraphConverter::network($similarities, $task);

        $values = $similarities->map(fn(Similarity $similarity) => $similarity->getOverlap() * 100);
        $sd = Descriptive::standardDeviation($values->toArray(), Descriptive::POPULATION);
        $normal = new Normal($values->average(), $sd);
        $nDist = (new Collection(range(1, 100)))->map(fn($index) => [
            'y' => round($normal->pdf($index), 4),
            'x' => $index,
        ]);


        return view("module-PlagiarismDetection::pages.dashboard")
            ->with('scores', $scores)
            ->with('similarities', $similarities)
            ->with('nameMap', $names)
            ->with('quartiles', $quartiles)
            ->with('network', $network)
            ->with('hiddenFiles', $hiddenFiles)
            ->with('normal', $nDist);
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
        dd($analysis->filePercentiles());
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

    public function compare(Course $course, Task $task, Project $from)
    {
        $analysis = $task->plagiarismAnalysis()->first();
        /** @var ProjectDownload $download */
        $download = $from->downloads()->first();
        $mainTree = $download->fileTree()->trim();
        // $overlaps = $analysis->comparisonsByProjectId($from->id)->orderBy('overlap', 'desc')->get();
        $comparisons = request()->collect('with')->map(fn($projectId) => ProjectDownload::with('project')->firstWhere('project_id', $projectId));
        $map = [];
        foreach($comparisons as $index => $comparison) {
            /** @var Collection $files */
            $files = $analysis->comparisonBetweenProjectIds($from->id, $comparisons[0]->project->id)->files()->orderBy('overlap', 'desc')->get();

            /** @var PlagiarismAnalysisFileComparison $file */
            foreach($files as $file) {
                $original = $file->perspective($from->project_id);
                if(!array_key_exists($original->getFile(), $map))
                    $map[$original->getFile()] = [];

                $perspective = $file->perspective($comparison->project_id);
                $map[$original->getFile()][$comparison->project_id] = [
                    'file'    => $perspective->getFile(),
                    'overlap' => $perspective->getOverlap()
                ];
            }
        }

        $projectMap = [];
        foreach($comparisons->map(fn($comparison) => $comparison->project_id) as $projectId) {
            $projectMap[$projectId] = collect($map)
                ->filter(fn($c) => array_key_exists($projectId, $c))
                ->mapWithKeys(fn($c, $originalFile) => [
                    $c[$projectId]['file'] => [
                        'file'    => $originalFile,
                        'overlap' => $c[$projectId]['overlap']
                    ]
                ]);
        }
        $treeMap = $comparisons->mapWithKeys(fn($download) => [$download->project_id => $download->fileTree()->trim()]);
        $masterSimilarities = collect($map)->mapWithKeys(fn($overlap, $originalFile) => [$originalFile => array_values($overlap)[0]]);
        $nameMap = Project::whereIn('id', collect([$from->id, ...$comparisons->pluck('project_id')]))->get()->map(fn(Project $project) => $project->owner_names);
        return view('module-PlagiarismDetection::pages.compare')
            ->with('tree', $mainTree)
            ->with('treeMap', $treeMap)
            ->with('nameMap', $nameMap)
            ->with('projectMap', $projectMap)
            ->with('master', $masterSimilarities)
            ->with('map', $map)
            ->with('from', $from);
    }

    public function compareDetails(Course $course, Task $task, Project $from)
    {
        $compareWith = request('compare_with');
        /** @var PlagiarismAnalysis $analysis */
        $analysis = $task->plagiarismAnalysis()->first();
        /** @var ProjectDownload $download */
        $download = $from->downloads()->first();

        $contents = $download->file(request('file'));
        $processedLines = (new Highlight(\request('file')))->code($contents);
        if($processedLines == null)
            return response("Can't be opened", 400);
        $comparison = $analysis->comparisonBetweenProjectIds($from->id, $compareWith);
        $index = $from->id == $comparison->project_1_id ? 1 : 2;
        $file = $comparison->files()->where("filename_$index", request('file'))->first();
        return [
            ...pathinfo(\request('file')),
            'full'  => \request('file'),
            'lines' => $processedLines,
            'mark'  => $file->perspective($from->id)->getLines()
        ];
    }
}
