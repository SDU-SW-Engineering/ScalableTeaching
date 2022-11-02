<?php

namespace App\Models\Enums;

enum TaskTypeEnum: string
{
    case Assignment = 'assignment';
    case Exercise = 'exercise';
}
