<?php

namespace App\Models;

use Carbon\Carbon;
use Domain\ActivityLogging\Course\CourseActivityLogging;
use Domain\ActivityLogging\Course\CourseActivityMessage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * @property string $role
 * @property Carbon $created_at
 */
class CourseUser extends Pivot
{
    use HasFactory;
    use CourseActivityLogging;

    public function logCreated(CourseUser $created): ?CourseActivityMessage
    {
        return new CourseActivityMessage('Joined the course.', $created->course_id, $created->user_id);
    }
}
