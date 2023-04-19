<?php

namespace App\Modules\PlagiarismDetection;


use App\Models\PlagiarismAnalysis;
use App\Models\PlagiarismAnalysisFileComparison;
use Illuminate\Support\Collection;

class ApexChartConverter
{
    public static function percentiles(PlagiarismAnalysis $analysis, $filterHiddenFiles = false): Collection
    {
        $files = $analysis->filePercentiles();

        if($filterHiddenFiles) {
            $hiddenFiles = $analysis->hiddenFiles()->pluck('filename');
            $files = $files->reject(fn($percentile, $fileName) => $hiddenFiles->contains($fileName));
        }


        $files = $files->map(fn(array $percentiles, string $file) => [
            'x' => $file,
            'y' => [$percentiles['min'], $percentiles[25], $percentiles[50], $percentiles[75], $percentiles['max']]
        ]);

        return $files->values();
    }

    public static function heatMap(PlagiarismAnalysis $analysis, $filterHiddenFiles = false)
    {
        $files = [];
        $similarities = $analysis->similarities();
        foreach($similarities as $similarity) {
            /** @var PlagiarismAnalysisFileComparison $file */
            foreach($similarity->files() as $file) {
                $file = $file->perspective($similarity->getProjectId());
                /** @var SimilarFile $file */
                $files[$file->getFile()][$similarity->getProjectId()] = [
                    'file_overlap'  => $file->getOverlap(),
                    'total_overlap' => $similarity->getOverlap(),
                    'compared_with' => $similarity->getProjectId()
                ];
            }
        }

        $files = collect($files);

        if($filterHiddenFiles) {
            $hiddenFiles = $analysis->hiddenFiles()->pluck('filename');
            $files = $files->reject(fn($percentile, $fileName) => $hiddenFiles->contains($fileName));
        }

        return $files->map(function($scores, $file) {
            $data = collect($scores)->sortBy('total_overlap')->map(fn($score, $project) => [
                'x'  => "$project",
                'y'  => round($score['file_overlap'] * 100, 2),
                'id' => $project
            ])->values();

            return [
                'name' => $file,
                'data' => $data,
            ];
        })->values();
    }
}
