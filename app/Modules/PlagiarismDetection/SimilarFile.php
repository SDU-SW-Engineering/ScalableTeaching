<?php

namespace App\Modules\PlagiarismDetection;

class SimilarFile implements \JsonSerializable
{
    public function __construct(
        private readonly string $file,
        private readonly float  $overlap,
        private readonly array  $lines,
        private readonly string $comparedWithFile,
        private readonly array  $comparedWithLines
    )
    {

    }


    public function jsonSerialize(): mixed
    {
        return [
            'file'          => $this->file,
            'overlap'       => $this->overlap,
            'lines'         => $this->lines,
            'compared_with' => [
                'file'  => $this->comparedWithFile,
                'lines' => $this->comparedWithLines,
            ]
        ];
    }

    public function percentiles()
    {

    }
}
