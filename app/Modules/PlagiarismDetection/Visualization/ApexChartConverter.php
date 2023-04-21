<?php

namespace App\Modules\PlagiarismDetection\Visualization;


use App\Models\PlagiarismAnalysis;
use App\Models\PlagiarismAnalysisFileComparison;
use App\Modules\PlagiarismDetection\SimilarFile;
use App\Modules\PlagiarismDetection\Similarity;
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

        /** filter anything with only one occurrence $files */
        $files = $files->reject(fn($percentiles, $path) => $percentiles['observations'] <= 2);

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

        /** filter anything with only one occurrence $files */
        $files = $files->reject(fn($entries, $path) => count($entries) == 1);
        $final = [];
        $sortedBySimilarity = $similarities->sortBy(fn(Similarity $similarity) =>  $similarity->getOverlap());

        foreach($files as $file => $scores) {
            $data = [];
            foreach($sortedBySimilarity as $comparison) {
                if(!array_key_exists($comparison->getProjectId(), $scores)) {
                    $data[] = [
                        'x'  => "{$comparison->getProjectId()}",
                        'y'  => 0,
                        'id' => $comparison->getProjectId()
                    ];
                    continue;
                }
                $score = $scores[$comparison->getProjectId()];
                $data[] = [
                    'x'  => "{$comparison->getProjectId()}",
                    'y'  => round($score['file_overlap'] * 100, 2),
                    'id' => $comparison->getProjectId()
                ];
            }
            $final[] = [
                'name' => $file,
                'data' => $data
            ];
        }
        return $final;
    }
}
