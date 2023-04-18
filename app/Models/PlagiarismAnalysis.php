<?php

namespace App\Models;

use App\Modules\PlagiarismDetection\Similarity;
use Carbon\Carbon;
use Eloquent;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/**
 * @property int $task_id
 * @property string $output
 * @property Carbon $analyzed_at
 * @property string $method
 * @mixin Eloquent
 */
class PlagiarismAnalysis extends Model
{
    use HasFactory;

    protected $casts = [
        'analyzed_at' => 'datetime'
    ];


    public function fileComparisons(): HasMany
    {
        return $this->hasMany(PlagiarismAnalysisFileComparison::class);
    }

    public function comparisons()
    {
        return $this->hasMany(PlagiarismAnalysisComparison::class);
    }

    /**
     * @param int $level
     * @return Collection<Similarity>
     */
    public function similarities(int $level = 1): Collection
    {
        $project2Base = PlagiarismAnalysisComparison::select('project_2_id as id', 'project_1_id as compared_with', 'overlap')
            ->where('plagiarism_analysis_id', $this->id);
        $baseQuery = PlagiarismAnalysisComparison::select('project_1_id as id', 'project_2_id as compared_with', 'overlap')
            ->where('plagiarism_analysis_id', $this->id)
            ->union($project2Base);


        $cte = \DB::table(\DB::raw("({$baseQuery->toSql()}) as base"))
            ->select('base.*', \DB::raw('ROW_NUMBER() over (PARTITION BY id ORDER BY overlap DESC) as rn'))
            ->mergeBindings($baseQuery->getQuery());

        $similarities = DB::table('similarities')
            ->withExpression('similarities', $cte)
            ->where('rn', '<=', $level);

        return $similarities->get()->map(fn($similarity) => new Similarity($similarity->id, $similarity->compared_with, $similarity->overlap, $this->id));
    }

    public function comparisonsByProjectId(int $projectId): HasMany
    {
        return $this->hasMany(PlagiarismAnalysisComparison::class)
            ->where('project_1_id', $projectId)
            ->orWhere('project_2_id', $projectId);
    }

    public function fileComparisonsByProject(int $projectId): HasMany
    {
        return $this->hasMany(PlagiarismAnalysisFileComparison::class)
            ->where('project_1_id', $projectId)
            ->orWhere('project_2_id', $projectId);
    }


}
