<?php

namespace App\Models;

use App\Models\Enums\FeedbackCommentStatus;
use Eloquent;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property ProjectFeedback $feedback
 * @property-read User $author
 * @property FeedbackCommentStatus $status
 * @mixin Eloquent
 */
class ProjectFeedbackComment extends Model
{
    use HasFactory;

    protected $fillable = ['filename', 'line', 'comment'];

    protected $hidden = ['status', 'mark_as', 'rejection_reason', 'filename'];

    protected $appends = ['time_since'];

    protected $casts = [
        'status' => FeedbackCommentStatus::class
    ];

    public function timeSince(): Attribute
    {
        return Attribute::make(get: fn() => $this->created_at->diffForHumans());
    }

    public function feedback(): BelongsTo
    {
        return $this->belongsTo(ProjectFeedback::class, 'project_feedback_id');
    }

    /**
     * @return Attribute<User,null>
     */
    public function author(): Attribute
    {
        return Attribute::make(get: fn() => $this->feedback->user);
    }
}
