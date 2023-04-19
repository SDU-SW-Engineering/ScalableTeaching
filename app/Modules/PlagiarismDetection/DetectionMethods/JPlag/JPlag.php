<?php

namespace App\Modules\PlagiarismDetection\DetectionMethods\JPlag;

use App\Models\PlagiarismAnalysis;
use App\Models\ProjectDownload;
use App\Models\Task;
use Illuminate\Support\Str;
use Storage;
use Symfony\Component\Process\Process;

class JPlag
{
    /**
     * @throws \Exception
     * @throws \Throwable
     */
    public function analyze(Task $task)
    {
        $baseDir = "tasks/$task->id/projects";
        $plagiarismAnalysis = new PlagiarismAnalysis();
        $plagiarismAnalysis->task_id = $task->id;

        $process = new Process(['docker', 'run', '-v', Storage::path($baseDir) . ":/files", '-v', Storage::path($baseDir) . ":/output", 'jazerix/jplag:latest']);
        $process->run();
        if(!$process->isSuccessful())
            throw new \Exception("Unable to analyze using JPlag");
        $plagiarismAnalysis->output = $process->getOutput();
        $plagiarismAnalysis->analyzed_at = now();
        $plagiarismAnalysis->method = 'jplag';
        $plagiarismAnalysis->save();
        // read output zip file*/

        throw_unless(Storage::exists($baseDir . '/output.zip'), \Exception::class, 'No output was generated from JPlag');
        $outputZip = new \ZipArchive();
        $outputZip->open(Storage::path($baseDir . '/output.zip'));
        $plagiarismAnalysis = PlagiarismAnalysis::first();
        for($i = 0; $i < $outputZip->numFiles; $i++) {
            $fileComparisons = [];
            $file = str($outputZip->getNameIndex($i));
            if(!$file->endsWith('.json') || $file == "overview.json")
                continue;
            $fp = $outputZip->getStream($file);
            $contents = null;
            while(!feof($fp))
                $contents .= fread($fp, 2);
            fclose($fp);
            $parsed = json_decode($contents, true);
            foreach($parsed['matches'] as $match) {
                $jplagMatch = new JPlagMatch($match["file1"], $match["file2"]);
                if(array_key_exists($jplagMatch->id(), $fileComparisons))
                    $jplagMatch = $fileComparisons[$jplagMatch->id()];
                else
                    $fileComparisons[$jplagMatch->id()] = $jplagMatch;
                $jplagMatch->addOverlap($match['start1'], $match['end1'], $match['start2'], $match['end2']);
            }
            foreach($fileComparisons as $comparison) {
                $file1Parts = str($comparison->file1)->explode('/');
                $file2Parts = str($comparison->file2)->explode('/');
                $plagiarismAnalysis->fileComparisons()->create([
                    'project_1_id' => str($file1Parts->shift())->explode("_")[0],
                    'project_2_id' => str($file2Parts->shift())->explode("_")[0],
                    'filename_1'   => $file1Parts->join('/'),
                    'filename_2'   => $file2Parts->join('/'),
                    'overlap'      => $comparison->calculatePercentage($baseDir),
                    'meta'         => [
                        'file1Overlap' => $comparison->file1Overlap,
                        'file2Overlap' => $comparison->file2Overlap
                    ]
                ]);
            }
            $plagiarismAnalysis->comparisons()->create([
                'project_1_id' => str($parsed['id1'])->explode("_")[0],
                'project_2_id' => str($parsed['id2'])->explode("_")[0],
                'overlap'      => $parsed['similarity']
            ]);
        }
        dd(2);
    }
}
