<?php

namespace App\Models;

use App\Models\Enums\FeedbackCommentStatus;
use Domain\Files\Highlight;
use Domain\Files\HighlightedLine;
use Eloquent;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection;

/**
 * @property ProjectFeedback $feedback
 * @property-read User $author
 * @property FeedbackCommentStatus $status
 * @property string $filename
 * @property int $line
 * @property string $comment
 * @mixin Eloquent
 */
class ProjectFeedbackComment extends Model
{
    use HasFactory;

    protected $fillable = ['filename', 'line', 'comment', 'status'];

    protected $hidden = ['mark_as'];

    protected $appends = ['time_since'];

    protected $casts = [
        'status' => FeedbackCommentStatus::class,
        'line'   => 'int'
    ];

    /**
     * @return Attribute<string,null>
     */
    public function timeSince(): Attribute
    {
        return Attribute::make(get: fn() => $this->created_at->diffForHumans());
    }

    /**
     * @return BelongsTo<ProjectFeedback,ProjectFeedbackComment>
     */
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

    /**
     * @return Collection<int,HighlightedLine>|null
     */
    public function lines(): ?Collection
    {
        $project = $this->feedback->project;
        $sha = $this->feedback->sha;
        $content = $this->feedback->project->downloads()->where('ref', $sha)->first()?->file($this->filename);

        return (new Highlight($this->filename))->code($content);
    }

    /**
     * @param int $lines
     * @return Collection<int,HighlightedLine>|null
     */
    public function surroundingCode(int $lines = 5): ?Collection
    {
        return $this->lines()->filter(fn(HighlightedLine $line) => $line->number > $this->line - $lines - 1 && $line->number < $this->line + $lines + 1);
    }
}
