<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * @property Carbon $created_at
 */
class CourseUser extends Pivot
{
    use HasFactory;
}
