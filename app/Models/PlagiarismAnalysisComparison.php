<?php

namespace App\Models;

use App\Modules\PlagiarismDetection\SimilarFile;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlagiarismAnalysisComparison extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_1_id',
        'project_2_id',
        'overlap',
    ];

    protected $casts = [
        'overlap' => 'double'
    ];

    /**
     * @return Builder
     */
    public function files(): Builder
    {
        return PlagiarismAnalysisFileComparison::where(function($query) {
            $query->where(function(Builder $query) {
                $query->where('project_1_id', $this->project_1_id)
                    ->where('project_2_id', $this->project_2_id);
            })->orWhere(function(Builder $query) {
                $query->where('project_1_id', $this->project_2_id)
                    ->where('project_2_id', $this->project_1_id);
            });
        });
    }

    public function perspective($projectId): array
    {
        $index = $projectId == $this->project_1_id ? 1 : 2;
        $comparedIndex = $index == 1 ? 2 : 1;

        return [
            'from' => $this["project_{$index}_id"],
            'to' => $this["project_{$comparedIndex}_id"]
        ];
    }
}
