<?php

namespace App\Models;

use App\Models\Enums\CourseActivityType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @mixin \Eloquent
 */
class CourseActivity extends Model
{
    use HasFactory;
    use Prunable;

    protected $fillable = ['course_id', 'affected_id', 'affected_by_id', 'message', 'type', 'additional', 'resource_type', 'resource_id'];

    protected $casts = [
        'type' => CourseActivityType::class,
        'additional' => 'array',
    ];

    /**
     * @return Builder<CourseActivity>
     */
    public function prunable(): Builder
    {
        return static::where('created_at', '<=', now()->subYears(2));
    }

    /**
     * @return MorphTo<Model,CourseActivity>
     */
    public function resource(): MorphTo
    {
        return $this->morphTo('resource');
    }

    /**
     * @return BelongsTo<User,CourseActivity>
     */
    public function affected(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo<User,CourseActivity>
     */
    public function affectedBy(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return Attribute<string,null>
     */
    public function kind(): Attribute
    {
        return Attribute::make(get: function ($value, $attributes) {
            return match ($this->resource_type) { // @phpstan-ignore-line
                Grade::class => 'Grade',
                CourseUser::class => 'Membership',
                Group::class => 'Group',
                GroupInvitation::class => 'Group Invitation',
                GroupUser::class => 'Group Membership',
            };
        });
    }
}
