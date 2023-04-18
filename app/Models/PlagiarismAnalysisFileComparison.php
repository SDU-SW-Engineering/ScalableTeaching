<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function percentiles(): Attribute
    {
        return Attribute::make(get: function() {
            return 2;
        });
    }

    /**
     * Since this method contains pointers to two projects, it can be difficult to distinguish which is the origin.
     * This method normalizes to the passed projectId, and it becomes origin
     * @param $projectId
     * @return array{file:string,overlap:double,lines:array,compared_with:array}
     */
    public function perspective($projectId): array
    {
        $index = $projectId == $this->project_1_id ? 1 : 2;
        $comparedIndex = $index == 1 ? 2 : 1;
        return [
            'file'          => $this["filename_$index"],
            'overlap'       => $this->overlap,
            'lines'         => $this->meta["file{$index}Overlap"],
            'compared_with' => [
                'file'  => $this["filename_$comparedIndex"],
                'lines' => $this->meta["file{$comparedIndex}Overlap"],
            ]
        ];
    }
}
