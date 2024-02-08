<?php

namespace App\Models\Enums;

/**
 * @deprecated In favor of the module system
 * Still in use by migration files from older tasks, can be deleted when we are sure all tasks are migrated.
 */
enum CorrectionType: string
{
    case None = 'none';
    case PipelineSuccess = 'pipeline_success';
    case Manual = 'manual';
    case AllTasks = 'all_tasks';
    case RequiredTasks = 'required_tasks';
    case NumberOfTasks = 'number_of_tasks';
    case PointsRequired = 'points_required';
    case Self = "self";
}
