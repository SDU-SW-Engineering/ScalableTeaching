<?php

namespace App\Modules\AutomaticGrading;

use App\Modules\MarkAsDone\MarkAsDone;
use App\Modules\Module;
use App\Modules\Subtasks\Subtasks;

class AutomaticGrading extends Module
{
    protected string $name = "Automatic Grading";

    protected string $icon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-lime-green-300">
  <path fill-rule="evenodd" d="M14.615 1.595a.75.75 0 01.359.852L12.982 9.75h7.268a.75.75 0 01.548 1.262l-10.5 11.25a.75.75 0 01-1.272-.71l1.992-7.302H3.75a.75.75 0 01-.548-1.262l10.5-11.25a.75.75 0 01.913-.143z" clip-rule="evenodd" />
</svg>
';
    protected string $description = "Tasks will be automatically graded (pass/failed) based on complete subtasks.";
    protected array $dependencies = [Subtasks::class];

    protected array $conflicts = [
        MarkAsDone::class,
    ];
}
