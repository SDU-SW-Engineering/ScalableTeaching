<?php

namespace App\Models;

use Badcow\PhraseGenerator\PhraseGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectFeedback extends Model
{
    use HasFactory;

    protected $table = 'project_feedback';
    protected $fillable = ['project_id', 'user_id', 'pseudonym', 'task_delegation_id', 'sha', 'reviewed'];

    protected $casts = [
        'reviewed' => 'bool'
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
}
