<?php

namespace App\Models\Enums;

enum ProjectDiffIndexStatus : string
{
    case Success = 'success';
    case Failure = 'failure';
}
