<?php

namespace App\Modules\PlagiarismDetection;

use App\Http\Controllers\Controller as BaseController;
use App\Models\Course;
use App\Models\PlagiarismAnalysis;
use App\Models\PlagiarismAnalysisComparison;
use App\Models\PlagiarismAnalysisFileComparison;
use App\Models\PlagiarismHiddenFile;
use App\Models\PlagiarismSuspicion;
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
        $overlaps = $analysis->comparisonsByProjectId($project->id)->orderBy('overlap', 'desc');

        /** @var PlagiarismAnalysisComparison $selectOverlap */
        $selectOverlap = $overlapId == null ? $overlaps->first() : $analysis->comparisonBetweenProjectIds($project->id, $overlapId);
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

        $other = $analysis->comparisonsByProjectId($project->id)->orderBy('overlap', 'desc')->get();
        $isSuspicious = $task->plagiarismSuspicions()
            ->where('project_1_id', $project->id)
            ->where('project_2_id', $selectOverlap->perspective($project->id)['to'])
            ->exists();
        return view("module-PlagiarismDetection::pages.details")
            ->with('project', $project)
            ->with('overlap', $selectOverlap)
            ->with('quartiles', $quartiles)
            ->with('userPlots', $userPlots)
            ->with('isSuspicious', $isSuspicious)
            ->with('other', $other);
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

    public function compare(Course $course, Task $task, Project $from)
    {
        $analysis = $task->plagiarismAnalysis()->first();
        /** @var ProjectDownload $download */
        $download = $from->downloads()->first();
        $mainTree = $download->fileTree()->trim();
        // $overlaps = $analysis->comparisonsByProjectId($from->id)->orderBy('overlap', 'desc')->get();
        $comparisons = request()->collect('with')->map(fn($projectId) => ProjectDownload::with('project')->firstWhere('project_id', $projectId));

        $treeMap = $comparisons->mapWithKeys(fn($download) => [$download->project_id => $download->fileTree()->trim()]);
        $dropdown = $analysis
            ->comparisonBetweenProjectIds($from->id, request('with')[0])->files()->orderBy('overlap', 'desc')
            ->get()
            ->map(function(PlagiarismAnalysisFileComparison $comparison) use ($from) {
                $similiarity = $comparison->perspective($from->id);
                return [
                    'from'    => $similiarity->getFile(),
                    'to'      => $comparison->perspective(request('with')[0])->getFile(),
                    'overlap' => $similiarity->getOverlap()
                ];
            });

        $nameMap = Project::whereIn('id', collect([$from->id, ...$comparisons->pluck('project_id')]))->get()
            ->mapWithKeys(fn(Project $project) => [$project->id => $project->owner_names]);

        $projectNames = $task->projects->pluck('owner_names', 'id');
        $fromCompareWith = $analysis->comparisonsByProjectId(request('with')[0])
            ->get()
            ->map(function(PlagiarismAnalysisComparison $overlap) use ($task, $course, $projectNames) {
                $perspective = $overlap->perspective(request('with')[0]);
                return [
                    'id'      => $perspective['to'],
                    'overlap' => $overlap->overlap,
                    'name'    => $projectNames[$perspective['to']],
                    'route'   => route('courses.tasks.admin.plagiarismDetection.compare', [$course, $task, $perspective['to'], 'with' => [request('with')[0]]])
                ];
            })
            ->sortByDesc('overlap')->values();
        $toCompareWith = $analysis->comparisonsByProjectId($from->id)
            ->get()
            ->map(function(PlagiarismAnalysisComparison $overlap) use ($from, $task, $course, $projectNames) {
                $perspective = $overlap->perspective($from->id);
                return [
                    'id'      => $perspective['to'],
                    'overlap' => $overlap->overlap,
                    'name'    => $projectNames[$perspective['to']],
                    'route'   => route('courses.tasks.admin.plagiarismDetection.compare', [$course, $task, $from->id, 'with' => [$perspective['to']]])
                ];
            })
            ->sortByDesc('overlap')->values();

        $markRoute = route('courses.tasks.admin.plagiarismDetection.markSuspicion', [$course, $task, $from]);
        $isSuspicious = $task->plagiarismSuspicions()
            ->where('project_1_id', $from->id)
            ->where('project_2_id', request('with')[0])
            ->exists();

        return view('module-PlagiarismDetection::pages.compare')
            ->with('tree', $mainTree)
            ->with('treeMap', $treeMap)
            ->with('nameMap', $nameMap)
            ->with('from', $from)
            ->with('to', request('with')[0])
            ->with('dropdown', $dropdown)
            ->with('fromCompared', $fromCompareWith)
            ->with('toCompared', $toCompareWith)
            ->with('markRoute', $markRoute)
            ->with('isSuspicious', $isSuspicious);
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
        if($compareWith == null) {
            return [
                ...pathinfo(\request('file')),
                'full'  => \request('file'),
                'lines' => $processedLines,
            ];
        }
        $comparison = $analysis->comparisonBetweenProjectIds($from->id, $compareWith);
        $index = $from->id == $comparison->project_1_id ? 1 : 2;
        $against = $index == 1 ? 2 : 1;
        $file = $comparison->files()
            ->where("filename_$index", request('file'))
            ->where("filename_$against", request('against'))->first();
        abort_if($file == null, 404);
        return [
            ...pathinfo(\request('file')),
            'full'  => \request('file'),
            'lines' => $processedLines,
            'mark'  => $file->perspective($from->id)->getLines()
        ];
    }

    public function markSuspicion(Course $course, Task $task, Project $from)
    {
        $to = request('to');
        $isSuspicious = $task->plagiarismSuspicions()
            ->where('project_1_id', $from->id)
            ->where('project_2_id', $to)
            ->exists();

        if($isSuspicious) {
            PlagiarismSuspicion::where([
                'project_1_id' => $from->id,
                'project_2_id' => $to,
                'task_id'      => $task->id
            ])->delete();
            PlagiarismSuspicion::where([
                'project_1_id' => $to,
                'project_2_id' => $from->id,
                'task_id'      => $task->id
            ])->delete();
            return "OK";
        }

        PlagiarismSuspicion::create([
            'project_1_id' => $from->id,
            'project_2_id' => $to,
            'task_id'      => $task->id
        ]);
        PlagiarismSuspicion::create([
            'project_1_id' => $to,
            'project_2_id' => $from->id,
            'task_id'      => $task->id
        ]);
        return "OK";
    }

    public function suspicions(Course $course, Task $task)
    {
        $suspicions = $task->plagiarismSuspicions()->get()->groupBy('project_1_id');
        return view("module-PlagiarismDetection::pages.suspicions")->with('suspicions', $suspicions);
    }

    public function removeSuspicions(Course $course, Task $task, Project $from)
    {
        $to = request('to');
        PlagiarismSuspicion::where([
            'project_1_id' => $from->id,
            'project_2_id' => $to,
            'task_id'      => $task->id
        ])->delete();
        PlagiarismSuspicion::where([
            'project_1_id' => $to,
            'project_2_id' => $from->id,
            'task_id'      => $task->id
        ])->delete();
        return redirect()->back();
    }

    public function addSuspicions(Course $course, Task $task, Project $from)
    {
        $to = request('to');
        PlagiarismSuspicion::create([
            'project_1_id' => $from->id,
            'project_2_id' => $to,
            'task_id'      => $task->id
        ]);
        PlagiarismSuspicion::create([
            'project_1_id' => $to,
            'project_2_id' => $from->id,
            'task_id'      => $task->id
        ]);
        return redirect()->back();
    }
}
