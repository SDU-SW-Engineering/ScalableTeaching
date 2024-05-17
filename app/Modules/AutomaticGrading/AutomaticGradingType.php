<?php

namespace App\Modules\AutomaticGrading;

enum AutomaticGradingType: string
{
    case PIPELINE_SUCCESS = 'pipeline_success'; // Pass the student if the pipeline is successful no matter the subtasks.
}
