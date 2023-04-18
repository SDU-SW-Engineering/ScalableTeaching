<?php

namespace App\Models;

use App\Modules\PlagiarismDetection\SimilarFile;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use MathPHP\Statistics\Descriptive;

/**
 * @property int $project_1_id
 * @property int $project_2_id
 */
class PlagiarismAnalysisFileComparison extends Model
{
    use HasFactory;

    protected $casts = [
        'meta'    => 'json',
        'overlap' => 'double'
    ];

    protected $fillable = [
        'project_1_id',
        'project_2_id',
        'filename_1',
        'filename_2',
        'overlap',
        'meta'
    ];

    /**
     * Since this method contains pointers to two projects, it can be difficult to distinguish which is the origin.
     * This method normalizes to the passed projectId, and it becomes origin
     * @param $projectId
     * @return SimilarFile
     */
    public function perspective($projectId): SimilarFile
    {

        $index = $projectId == $this->project_1_id ? 1 : 2;
        $comparedIndex = $index == 1 ? 2 : 1;

        return new SimilarFile($this["filename_$index"], $this->overlap, $this->meta["file{$index}Overlap"],  $this["filename_$comparedIndex"], $this->meta["file{$comparedIndex}Overlap"]);
    }

    public static function percentiles(int $analysisId, string $targetFile = null)
    {
        $files = [];
        foreach (PlagiarismAnalysisFileComparison::where('plagiarism_analysis_id', $analysisId)->get() as $file)
        {
            foreach (['filename_1', 'filename_2'] as $columnName)
            {
                $fileName = $file->$columnName;
                if ($targetFile != null && $fileName != $targetFile)
                    continue;
                if (!array_key_exists($fileName, $files))
                    $files[$fileName] = [];
                $files[$fileName][] = $file->overlap;
            }
        }
        return (new Collection($files))->map(fn(array $overlaps, string $fileName) => [
            'min' => min($overlaps),
            '25' => Descriptive::percentile($overlaps, 25),
            '50' => Descriptive::percentile($overlaps, 50),
            '75' => Descriptive::percentile($overlaps, 75),
            'max' => max($overlaps)
        ]);
    }
}
