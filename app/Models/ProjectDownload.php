<?php

namespace App\Models;

use Carbon\Carbon;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $project_id
 * @property-read Project $project
 * @property Carbon $downloaded_at
 * @property string $ref
 * @property-read bool $isDownloaded
 * @property string $location
 * @mixin Eloquent
 */
class ProjectDownload extends Model
{
    use HasFactory;

    protected $fillable = ['downloaded_at', 'location', 'expire_at', 'ref'];

    protected $dates = ['downloaded_at'];

    /**
     * @return BelongsTo<Project,ProjectDownload>
     */
    public function project() : BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * @param Builder<ProjectDownload> $query
     * @return Builder<ProjectDownload>
     */
    public function scopeQueued(Builder $query) : Builder
    {
        return $query->whereNull('downloaded_at');
    }

    /**
     * @return Attribute<bool,null>
     */
    public function isDownloaded() : Attribute
    {
        return Attribute::make(get: fn($value, $attributes) => $attributes['downloaded_at'] != null);
    }
}
