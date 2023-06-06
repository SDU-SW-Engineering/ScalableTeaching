<?php

namespace App\Modules;

use App\Modules\AutomaticDownload\AutomaticDownload;
use App\Modules\AutomaticGrading\AutomaticGrading;
use App\Modules\BuildTracking\BuildTracking;
use App\Modules\LinkRepository\LinkRepository;
use App\Modules\PreloadRepositories\PreloadRepositories;
use App\Modules\SubtaskGradingAndFeedback\SubtaskGradingAndFeedback;
use App\Modules\MarkAsDone\MarkAsDone;
use App\Modules\ProtectFiles\ProtectFiles;
use App\Modules\Subtasks\Subtasks;
use App\Modules\Template\Template;

class Kernel
{
    public array $modules = [
        MarkAsDone::class,
        LinkRepository::class,
        Template::class,
        Subtasks::class,
        AutomaticGrading::class,
        BuildTracking::class,
        SubtaskGradingAndFeedback::class,
        AutomaticDownload::class,
        ProtectFiles::class,
        PreloadRepositories::class,
    ];
}
