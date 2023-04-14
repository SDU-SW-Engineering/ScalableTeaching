<?php

namespace App\Modules\PlagiarismDetection\DetectionMethods\JPlag;

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\Storage;

class JPlagMatch
{
    public string $file1;
    public string $file2;

    public array $file1Overlap = [];
    public array $file2Overlap = [];

    public int $file1LineOverlap = 0;
    public int $file2LineOverlap = 0;

    /**
     * @param string $file1
     * @param string $file2
     */
    public function __construct(string $file1, string $file2)
    {
        $this->file1 = $file1;
        $this->file2 = $file2;
    }

    public function id(): string
    {
        return strcmp($this->file1, $this->file2) < 0 ? "$this->file1:$this->file2" : "$this->file2:$this->file1";
    }

    public function addOverlap(int $file1Start, int $file1End, int $file2Start, int $file2End)
    {
        $this->file1Overlap[] = [$file1Start, $file1End];
        $this->file2Overlap[] = [$file2Start, $file2End];
        $lineCountFile1 = $file1End - ($file1Start - 1);
        $lineCountFile2 = $file2End - ($file2Start - 1);
        $this->file1LineOverlap += $lineCountFile1;
        $this->file2LineOverlap += $lineCountFile2;
    }

    /**
     * @throws FileNotFoundException
     */
    public function calculatePercentage($basePath)
    {
        $file1Path = Storage::path($basePath . '/' . $this->file1);
        $file2Path = Storage::path($basePath . '/' . $this->file2);
        $handle = fopen($file1Path, "r");
        $file1LineCount = 0;
        while(!feof($handle)){
            fgets($handle);
            $file1LineCount++;
        }

        $handle = fopen($file2Path, "r");
        $file2LineCount = 0;
        while(!feof($handle)){
            fgets($handle);
            $file2LineCount++;
        }


        $file1Overlap = $this->file1LineOverlap / $file1LineCount;
        $file2Overlap = $this->file2LineOverlap / $file2LineCount;

        return ($file1Overlap + $file2Overlap) / 2;
    }
}
