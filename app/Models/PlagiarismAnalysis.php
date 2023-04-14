<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $task_id
 * @property string $output
 * @property Carbon $analyzed_at
 * @property string $method
 */
class PlagiarismAnalysis extends Model
{
    use HasFactory;

    protected $casts = [
        'analyzed_at' => 'datetime'
    ];



    public function fileComparisons() : HasMany
    {
        return $this->hasMany(PlagiarismAnalysisFileComparison::class);
    }

    public function comparisons()
    {
        return $this->hasMany(PlagiarismAnalysisComparison::class);
    }
}
