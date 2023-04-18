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

    /**
     * @return string
     */
    public function getFile(): string
    {
        return $this->file;
    }

    /**
     * @return float
     */
    public function getOverlap(): float
    {
        return $this->overlap;
    }

    /**
     * @return array
     */
    public function getLines(): array
    {
        return $this->lines;
    }

    /**
     * @return string
     */
    public function getComparedWithFile(): string
    {
        return $this->comparedWithFile;
    }

    /**
     * @return array
     */
    public function getComparedWithLines(): array
    {
        return $this->comparedWithLines;
    }
}
