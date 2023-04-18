<?php

namespace App\Modules\PlagiarismDetection;


use App\Models\PlagiarismAnalysis;
use Illuminate\Support\Collection;

class ApexChartConverter
{
    public static function percentiles(PlagiarismAnalysis $analysis) : Collection
    {
        return $analysis->filePercentiles()->map(fn(array $percentiles, string $file) => [
            'x' => $file,
            'y' => [$percentiles['min'] * 100, $percentiles[25] * 100, $percentiles[50] * 100, $percentiles[75] * 100, $percentiles['max'] * 100]
        ])->values();
    }
}
