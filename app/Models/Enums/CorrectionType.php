<?php

namespace App\Models\Enums;

enum CorrectionType: string
{
    case None = 'none';
    case PipelineSuccess = 'pipeline_success';
    case Manual = 'manual';
    case AllTasks = 'all_tasks';
    case RequiredTasks = 'required_tasks';
    case NumberOfTasks = 'number_of_tasks';
    case PointsRequired = 'points_required';
}
