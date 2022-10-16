<?php

namespace App\Models;

use Badcow\PhraseGenerator\PhraseGenerator;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $user_id
 * @property User $user
 * @property bool $reviewed
 * @property-read Project $project
 * @property TaskDelegation $taskDelegation
 * @property string $sha
 * @mixin Eloquent
 */
class ProjectFeedback extends Model
{
    use HasFactory;

    protected $table = 'project_feedback';
    protected $fillable = ['project_id', 'user_id', 'pseudonym', 'task_delegation_id', 'sha', 'reviewed'];

    protected $casts = [
        'reviewed' => 'bool',
    ];

    public static function booted()
    {
        static::creating(function (ProjectFeedback $gradeDelegation) {
            do
            {
                $pseudonym = PhraseGenerator::generate(2);
            } while(static::where('pseudonym', $pseudonym)->where('user_id', $gradeDelegation->user_id)->exists());
            $gradeDelegation->pseudonym = $pseudonym;
        });
    }

    public function download() : ?ProjectDownload
    {
        return ProjectDownload::where('ref', $this->sha)->first();
    }

    /**
     * @param Builder<ProjectFeedback> $query
     * @return Builder<ProjectFeedback>
     */
    public function scopeUnreviewed(Builder $query) : Builder
    {
        return $query->where('reviewed', false);
    }

    /**
     * @param Builder<ProjectFeedback> $query
     * @return Builder<ProjectFeedback>
     */
    public function scopeReviewed(Builder $query) : Builder
    {
        return $query->where('reviewed', true);
    }
    /**
     * @return BelongsTo<User,ProjectFeedback>
     */
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo<Project,ProjectFeedback>
     */
    public function project() : BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * @return HasMany<ProjectFeedbackComment>
     */
    public function comments() : HasMany
    {
        return $this->hasMany(ProjectFeedbackComment::class);
    }

    /**
     * @return BelongsTo<TaskDelegation,ProjectFeedback>
     */
    public function taskDelegation() : BelongsTo
    {
        return $this->belongsTo(TaskDelegation::class);
    }
}
