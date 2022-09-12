<?php

namespace App\Models;

use Domain\ActivityLogging\Course\CourseActivityLogging;
use Domain\ActivityLogging\Course\CourseActivityMessage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * @property int $user_id
 */
class GroupUser extends Pivot
{
    use CourseActivityLogging;

    protected $casts = ['is_owner' => 'bool'];

    /**
     * @return BelongsTo<Group,GroupUser>
     */
    public function group() : BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    protected function logCreated(GroupUser $created): ?CourseActivityMessage
    {
        return new CourseActivityMessage("Joined group \"{$this->group->name}\".", $this->group->course_id, $created->user_id);
    }

    protected function logDeleted(GroupUser $deleted): ?CourseActivityMessage
    {
        return new CourseActivityMessage("Left group \"{$this->group->name}\".", $this->group->course_id, $deleted->user_id);
    }
}
