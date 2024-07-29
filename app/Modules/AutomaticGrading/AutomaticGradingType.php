<?php

namespace App\Modules\AutomaticGrading;

enum AutomaticGradingType: string
{
    case PIPELINE_SUCCESS = 'pipeline_success'; // Pass the student if the pipeline is successful no matter the subtasks.
    case ALL_SUBTASKS = 'all_subtasks'; // Pass the student if all subtasks are successful when a pipeline request comes in.
    case REQUIRED_SUBTASKS = 'required_subtasks'; // Pass the student if all required subtasks are successful when a pipeline request comes in.
    case POINTS_REQUIRED = 'points_required'; // Pass the student if the student has enough points.
}
