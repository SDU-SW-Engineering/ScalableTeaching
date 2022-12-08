<?php

namespace App\Tasks\Validation;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Support\Collection;

interface SubmissionValidation
{
    /**
     * @return Collection<int,string>
     */
    public function validate(Task $task, Project $project) : Collection;
}
