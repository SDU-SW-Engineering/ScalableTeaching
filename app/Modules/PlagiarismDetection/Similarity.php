<?php

namespace App\Modules\PlagiarismDetection;

use App\Models\PlagiarismAnalysisFileComparison;
use App\Models\Project;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use JsonSerializable;

class Similarity implements JsonSerializable
{
    public function __construct(
        private readonly int   $projectId,
        private readonly int   $comparedWithProjectId,
        private readonly float $overlap,
        private readonly int   $analysisId
    )
    {

    }

    /**
     * @return int
     */
    public function getProjectId(): int
    {
        return $this->projectId;
    }

    /**
     * @return int
     */
    public function getComparedWithProjectId(): int
    {
        return $this->comparedWithProjectId;
    }

    /**
     * @return float
     */
    public function getOverlap(): float
    {
        return $this->overlap;
    }

    public function getSummarizedFileOverlap(array $omit = [])
    {
        return $this->fileQuery()->get()->reject(function(PlagiarismAnalysisFileComparison $file) use ($omit) {
            return in_array($file->perspective($this->projectId)->getFile(), $omit);
        })->average('overlap');
    }

    private function fileQuery()
    {
        return PlagiarismAnalysisFileComparison::where('plagiarism_analysis_id', $this->analysisId)
            ->where(function(Builder $query) {
                $query->where('project_1_id', $this->projectId)
                    ->where('project_2_id', $this->comparedWithProjectId);
            })->orWhere(function(Builder $query) {
                $query->where('project_1_id', $this->comparedWithProjectId)
                    ->where('project_2_id', $this->projectId);
            });
    }

    /**
     * @return mixed
     */
    public function files(): Collection
    {
        return $this->fileQuery()->get();
    }

    public function project(): Project
    {
        return Project::find($this->projectId);
    }

    public function comparedWith(): Project
    {
        return Project::find($this->comparedWithProjectId);
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id'            => $this->projectId,
            'overlap'       => $this->overlap,
            'compared_with' => $this->comparedWithProjectId
        ];
    }
}
