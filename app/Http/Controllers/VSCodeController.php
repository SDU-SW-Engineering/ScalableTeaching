<?php

namespace App\Http\Controllers;

use App\Jobs\Project\DownloadProject;
use App\Models\Casts\SubTask;
use App\Models\Casts\SubTaskCollection;
use App\Models\Course;
use App\Models\GradeDelegation;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use App\ProjectStatus;
use Cache;
use Domain\Files\Directory;
use Domain\Files\File;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Scalar\MagicConst\Dir;
use Storage;
use ZipArchive;

class VSCodeController extends Controller
{
    public function authenticate(Request $request)
    {
        $validated = Validator::make($request->all(), ['token' => 'required']);
        if($validated->fails())
            return "Token missing";
        Cache::remember('vs-code-auth:' . $request->get('token'), 180, fn() => auth()->id());

        return "Successfully logged in, you may now close this window.";
    }

    public function retrieveAuthentication(Request $request)
    {
        $validated = Validator::make($request->all(), ['token' => 'required']);
        if($validated->fails())
            return response("Token missing", 400);
        $token = $request->get('token');
        if(!Cache::has("vs-code-auth:$token"))
            return response(['type' => 'error', 'message' => 'Not found'], 404);

        $userId = Cache::get("vs-code-auth:$token");
        $user = User::find($userId);
        $userToken = $user->createToken("vs-code");
        Cache::forget("vs-code-auth:$token");

        return [
            'type'  => 'success',
            'token' => $userToken->plainTextToken,
            'name'  => $user->name
        ];
    }

    public function courses()
    {
        return auth()->user()->courses()->withCount('members')->get();
    }

    public function gradingScheme()
    {
        /** @var Task $task */
        $task = Task::find(14);
        //$this->createDemoSubTasks($task);
        return $task->sub_tasks->all()->groupBy('group')->map(fn($tasks, $group) => ['group' => $group, 'tasks' => $tasks])->values();
    }

    public function createDemoSubTasks(Task $task)
    {
        $task->update([
            'sub_tasks' => new SubTaskCollection(collect([
                (new SubTask("Declared 2 variables with right types", null, '1A: public class Brewery'))->setPoints(2),
                (new SubTask("Appropriate access modifiers on the variables", null, '1A: public class Brewery'))->setPoints(2),
                (new SubTask("Constructor with relevant parameters and variables instantiation in 2 constructor", null, '1A: public class Brewery'))->setPoints(2),
                (new SubTask("Getter methods for the 2 variables", null, '1A: public class Brewery'))->setPoints(2),
                (new SubTask("CompareTo() method implemented correctly", null, '1A: public class Brewery'))->setPoints(4),
                (new SubTask("CompareTo() method not implemented correctly with getter methods", null, '1A: public class Brewery'))->setPoints(2),
                (new SubTask("Is the code runnable / has the correct output?", null, '1A: public class Brewery'))->setPoints(3),

                (new SubTask("createMaps(): Created Map instance correctly", null, '1B: public class BreweriesAndBeers'))->setPoints(2),
                (new SubTask("createMaps(): Declare a scanner outside a try/catch or as a parameter to the try clause of 2 autoclosable", null, '1B: public class BreweriesAndBeers'))->setPoints(2),
                (new SubTask("createMaps(): Catch clause catch relevant exceptions", null, '1B: public class BreweriesAndBeers'))->setPoints(2),
                (new SubTask("createMaps(): Scanner is closed (either directly or with autocloseable)", null, '1B: public class BreweriesAndBeers'))->setPoints(2),
                (new SubTask("createMaps(): Relevant parameters are extracted from each line in the file using a right 4 splitter parameter (“\\t”)", null, '1B: public class BreweriesAndBeers'))->setPoints(4),
                (new SubTask("createMaps(): trim() method used on the name and id read from the file to remove 1 unwanted stuff from the string.", null, '1B: public class BreweriesAndBeers'))->setPoints(1),
                (new SubTask("createMaps(): Name and id are added to the map using put().", null, '1B: public class BreweriesAndBeers'))->setPoints(2),
                (new SubTask("createMaps(): Map instance is returned.", null, '1B: public class BreweriesAndBeers'))->setPoints(2),
                (new SubTask("write2File(): Writer object is declared outside a try/catch or as a parameter to the try 2 clause of autoclosable.", null, '1B: public class BreweriesAndBeers'))->setPoints(2),
                (new SubTask("write2File(): Writer object is created in a correct way using “append mode”.", null, '1B: public class BreweriesAndBeers'))->setPoints(2),
                (new SubTask("write2File(): Writer object is created but not using “append mode”.", null, '1B: public class BreweriesAndBeers'))->setPoints(1),
                (new SubTask("write2File(): Iterated over brewerySet correctly and used toString() method 4 Brewery.java to write in the file", null, '1B: public class BreweriesAndBeers'))->setPoints(4),
                (new SubTask("write2File(): Catch clause to catch relevant exceptions", null, '1B: public class BreweriesAndBeers'))->setPoints(2),
                (new SubTask("Is the code runnable / has the correct output?", null, '1B: public class BreweriesAndBeers'))->setPoints(3),

                (new SubTask("Compare() method implemented correctly?", null, '1C: public class BreweryComparator'))->setPoints(5),
                (new SubTask("Compare() method not implemented with getter methods?", null, '1C: public class BreweryComparator'))->setPoints(2),

                (new SubTask("Sorted Set of type Brewery is created correctly (using TreeSet and 3 Brewerycomparator as an argument)", null, '1C: public class BreweriesAndBeers'))->setPoints(3),
                (new SubTask("brewerySet elements are added to the sorted set correctly", null, '1C: public class BreweriesAndBeers'))->setPoints(2),
                (new SubTask("Sorted Set is assigned to brewerySet", null, '1C: public class BreweriesAndBeers'))->setPoints(2),
                (new SubTask("Is the code runnable / has the correct output?", null, '1C: public class BreweriesAndBeers'))->setPoints(3),

                (new SubTask("countryList is initialized correctly in the constructor", null, '2A: public class WhiskeyStatistics'))->setPoints(2),
                (new SubTask("readFile(): Declare a scanner outside a try/catch or as a parameter to the try clause of 2 autoclosable", null, '2A: public class WhiskeyStatistics'))->setPoints(2),
                (new SubTask("readFile(): Catch clause catch relevant exceptions", null, '2A: public class WhiskeyStatistics'))->setPoints(2),
                (new SubTask("readFile(): Scanner is closed (either directly or with autocloseable)", null, '2A: public class WhiskeyStatistics'))->setPoints(2),
                (new SubTask("readFile(): Relevant parameters are extracted from each line in the file using a right 5 splitter parameter (“\\t”)", null, '2A: public class WhiskeyStatistics'))->setPoints(5),
                (new SubTask("readFile(): Extracted parameters are used to instantiate a Country object", null, '2A: public class WhiskeyStatistics'))->setPoints(2),
                (new SubTask("readFile(): Country object is added to the countryList", null, '2A: public class WhiskeyStatistics'))->setPoints(2),
                (new SubTask("Is the code runnable / has the correct output?", null, '2A: public class WhiskeyStatistics'))->setPoints(3),

                (new SubTask("Declared an instance of WhiskeyStatistics", null, '2B: public class PrimaryController'))->setPoints(2),
                (new SubTask("Initialized the declared instance of WhiskeyStatistics in the initialize() 2 method", null, '2B: public class PrimaryController'))->setPoints(2),
                (new SubTask("There is a check for selected Buttons", null, '2B: public class PrimaryController'))->setPoints(2),
                (new SubTask("On clicking \"Read File\" button, the file Whiskey.txt is read and file content 4 appears in the TextArea", null, '2B: public class PrimaryController'))->setPoints(4),
                (new SubTask("On clicking \"Clear\" button, the TextArea is cleared", null, '2B: public class PrimaryController'))->setPoints(2),
                (new SubTask("On clicking \"Sort\" button, the sort() method in the WhiskeyStatistic class is 5 called and the sorted content is displayed in the TextArea.", null, '2B: public class PrimaryController'))->setPoints(5),
                (new SubTask("Is the code runnable / has the correct output?", null, '2B: public class PrimaryController'))->setPoints(5),
            ]))
        ]);
    }

    public function courseTasks(Course $course)
    {
        $tasks = $course->tasks()->with('projects')->get()->keyBy('id');
        $tasks->makeHidden('description');
        $tasks->makeHidden('markdown_description');

        $delegatedProjectIds = auth()->user()->gradeDelegations()->pluck('pseudonym', 'project_id');
        $delegatedProjects = Project::with(['task' => function(BelongsTo $query) {
            $query->select('id', 'name');
        }])->whereIn('task_id', $tasks->pluck('id'))
            ->whereIn('id', $delegatedProjectIds->flip())
            ->get()
            ->map(fn(Project $project) => [
                'repo_name' => $delegatedProjectIds[$project->id],
                'task_id'   => $project->task_id,
                'status'    => $project->status,
                'id'        => $project->id
            ]);


        return $delegatedProjects->groupBy('task_id')
            ->map(fn($projects, $taskId) => ['id' => $taskId, 'name' => $tasks[$taskId]->name, 'projects' => $projects])
            ->values();
    }

    public function fileTree(Course $course, Task $task, Project $project)
    {
        $download = $project->latestDownload();
        if($download === false)
            return response("Project not available, as student hasn't handed in before deadline.", 404);

        if($download === null || $download->isDownloaded == false)
            return response("This task is not available yet. Try again later.", 404);

        $file = Storage::disk('local')->path($download->location);
        $zip = new ZipArchive();
        $zip->open($file, ZipArchive::RDONLY);
        $root = new Directory(".");
        for($i = 0; $i < $zip->numFiles; $i++) {
            $fileName = $zip->getNameIndex($i);
            $path = explode('/', $fileName);
            $currentDir = $root;
            for($j = 0; $j < count($path); $j++) {
                $file = $path[$j];
                if($j + 1 < count($path)) {
                    $nextDirectory = $currentDir->getDirectory($file) ?? $currentDir->addDirectory(new Directory($file));
                    $currentDir = $nextDirectory;
                    continue;
                }
                if($file == "")
                    continue;
                $currentDir->addFile(new File($fileName));;
            }
        }

        return $root->nextDirectoryWithFiles();
    }

    public function file(Course $course, Task $task, Project $project)
    {
        $file = \request('file');

        $download = $project->latestDownload();
        if($download == null || $download->isDownloaded == false)
            return response("This task is not available yet. Try again later.", 404);

        $fileOnDisk = Storage::disk('local')->path($download->location);
        $zip = new ZipArchive();
        $zip->open($fileOnDisk);
        $fp = $zip->getStream($file);
        $contents = null;
        while(!feof($fp)) {
            $contents .= fread($fp, 2);
        }
        fclose($fp);

        return [
            'file' => $contents
        ];
    }

    /**
     * @throws \Exception
     */
    public function submitGrading(Course $course, Task $task, Project $project)
    {
        $userDelegation = $project->gradeDelegations()->firstWhere('user_id', auth()->id());
        abort_if($userDelegation == null, 403, "You can't grade this project.");
        $project->subTasks()->delete();
        $project->subTasks()->createMany(collect(request()->all())->map(fn($subTaskId) => [
            'sub_task_id' => $subTaskId,
            'source_type' => GradeDelegation::class,
            'source_id'   => $userDelegation->id
        ]));

        $project->setProjectStatusFor(ProjectStatus::Finished, GradeDelegation::class, $userDelegation->id, [
            'subtasks' => \request()->all()
        ]);

        return "OK";
    }
}
