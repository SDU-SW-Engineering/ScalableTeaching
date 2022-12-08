<?php

namespace App\Tasks\Validation;

use App\Models\Project;
use App\Models\Task;
use App\Models\TaskProtectedFile;
use Domain\SourceControl\Directory;
use Domain\SourceControl\DirectoryCollection;
use Domain\SourceControl\SourceControl;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class ProtectedFilesUntouched implements SubmissionValidation
{

    public function validate(Task $task, Project $project): Collection
    {
        /** @var Collection<int,string> $errors */
        $errors = new Collection();
        $protectedFiles = $task->protectedFiles;
        $directories = $this->loadFiles($protectedFiles, $project);
        foreach($protectedFiles as $protectedFile) {
            $currentFile = $directories->getFile($protectedFile->path);
            if ($protectedFile->sha_values->contains($currentFile->getSha()))
                continue;
            $errors[] = "{$protectedFile->path} has been altered. Expected one of [{$protectedFile->sha_values->join(", ")}] but was {$currentFile->getSha()}";
        }

        return $errors;
    }

    /**
     * @param Collection<int,TaskProtectedFile> $protectedFiles
     * @param Project $project
     * @return DirectoryCollection
     */
    private function loadFiles(Collection $protectedFiles, Project $project): DirectoryCollection
    {
        /** @var Collection<int,string> $directories */
        $directories = new Collection();
        foreach($protectedFiles as $protectedFile) { // todo: need more work
            $path = Str::of($protectedFile->path);
            if(!$path->contains('/')) {
                $directories[] = "/";
                continue;
            }
            $pathParts = $path->explode("/");
            $pathParts = $pathParts->slice(0, $pathParts->count() - 1);

            $directories[] = $pathParts->join("/");
        }
        $directories = new DirectoryCollection($directories->mapInto(Directory::class));
        app(SourceControl::class)->getFilesFromDirectories("$project->project_id", $directories);
        return $directories;
    }
}
