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
        $baseDir = "tasks/$task->id/plagiarism_detection/jplag";
        /*$dirExists = Storage::exists($baseDir);
        if(!$dirExists)
            Storage::makeDirectory($baseDir);

        Storage::delete('output.zip');
        $plagiarismAnalysis = new PlagiarismAnalysis();
        $plagiarismAnalysis->task_id = $task->id;
        // unzip files
        /** @var ProjectDownload $download */
        /* foreach($task->downloads as $download) {
             Storage::deleteDirectory("$baseDir/$download->project_id"); // ensures we always get the latest download
             $zip = new \ZipArchive();
             $zip->open(Storage::path($download->location));
             $zipBaseDir = $zip->getNameIndex(0);
             $zip->extractTo(Storage::path($baseDir));
             Storage::move("$baseDir/$zipBaseDir", "$baseDir/$download->project_id");
             // move files to plagiarism folder with new name that's linked to method used + id of download
             $zip->close();
         }

         // pass to docker command
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
                    'project_1_id' => $file1Parts->shift(),
                    'project_2_id' => $file2Parts->shift(),
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
                'project_1_id' => $parsed['id1'],
                'project_2_id' => $parsed['id2'],
                'overlap'      => $parsed['similarity']
            ]);
        }
        dd(2);
    }
}
