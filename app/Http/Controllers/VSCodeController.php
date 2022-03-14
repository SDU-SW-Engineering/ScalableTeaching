<?php

namespace App\Http\Controllers;

use App\Jobs\Project\DownloadProject;
use App\Models\Course;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Cache;
use Domain\Files\Directory;
use Domain\Files\File;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Scalar\MagicConst\Dir;
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

    public function courseTasks(Course $course)
    {
        $tasks = $course->tasks()->with(['projects' => function(HasMany $query) {

        }])->get();
        $tasks->makeHidden('description');
        $tasks->makeHidden('markdown_description');
        return $tasks;
    }

    public function fileTree(Course $course, Task $task, Project $project)
    {
        // dispatch(new DownloadProject($project, 'main'));
        $file = \Storage::disk('local')->path("tasks/{$project->task_id}/projects/{$project->id}_main.zip");

        $zip = new \ZipArchive();
        $zip->open($file, ZipArchive::RDONLY);
        $root = new Directory(".");
        for($i = 0; $i < $zip->numFiles; $i++) {
            $fileName = $zip->getNameIndex($i);
            $path = explode('/', $fileName);
            $currentDir = $root;
            for($j = 0; $j < count($path); $j++)
            {
                $file = $path[$j];
                if ($j +1 < count($path))
                {
                    $nextDirectory = $currentDir->getDirectory($file) ?? $currentDir->addDirectory(new Directory($file));
                    $currentDir = $nextDirectory;
                    continue;
                }
                if ($file == "")
                    continue;
               $currentDir->addFile(new File($fileName));;
            }
        }

        return $root->nextDirectoryWithFiles();
    }

    public function file(Course $course, Task $task, Project $project)
    {
        $file = \request('file');

        $fileOnDisk = \Storage::disk('local')->path("tasks/{$project->task_id}/projects/{$project->id}_main.zip");
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
}
