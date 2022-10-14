<?php

namespace App\Models\Enums;

enum TaskDelegationType: string
{
    case LastPushes = 'last_pushes';
    case SucceedingPushes = 'succeeding_pushes';
    case SucceedingOrLastPushes = 'succeed_last_pushes';
}
