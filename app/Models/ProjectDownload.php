<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
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
 */
class ProjectDownload extends Model
{
    use HasFactory;

    protected $fillable = ['downloaded_at', 'location', 'expire_at', 'ref'];

    protected $dates = ['downloaded_at'];

    public function project() : BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function scopeQueued(Builder $query) : Builder
    {
        return $query->whereNull('downloaded_at');
    }

    public function getIsDownloadedAttribute() : bool
    {
        return $this->downloaded_at != null;
    }
}
