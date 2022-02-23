<?php

namespace App\Models\Enums;

enum PipelineStatusEnum : string
{
    case Success = "success";
    case Failed = "failed";
    case Pending = "pending";
    case Running = "running";
}
