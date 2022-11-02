<?php

namespace App\Models\Enums;

enum CourseActivityType: string
{
    case Created = 'created';
    case Updated = 'updated';
    case Deleted = 'deleted';
}
