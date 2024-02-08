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
        if ($protectedFiles->count() == 0)
            return $errors;
        $directories = $this->loadFiles($protectedFiles, $project);
        foreach($protectedFiles as $protectedFile)
        {
            if ($protectedFile->sha_values == null)
                continue;
            $userFile = $directories->getFile($protectedFile->path);
            if ($userFile == null)
            {
                $errors[] = "$protectedFile->path has been removed.";
                continue;
            }
            if ($protectedFile->sha_values->contains($userFile->getSha()))
                continue;
            $errors[] = "$protectedFile->path has been altered. Expected one of [{$protectedFile->sha_values->join(", ")}] but was {$userFile->getSha()}";
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
        $files = $protectedFiles->map(fn(TaskProtectedFile $taskProtectedFile) => $taskProtectedFile->path);
        $directoryCollection = DirectoryCollection::fromFiles($files);
        app(SourceControl::class)->getFilesFromDirectories("$project->gitlab_project_id", $directoryCollection);

        return $directoryCollection;
    }
}
