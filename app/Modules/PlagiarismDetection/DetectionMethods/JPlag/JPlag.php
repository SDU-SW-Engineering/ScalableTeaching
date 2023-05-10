<?php

namespace App\Modules\PlagiarismDetection\DetectionMethods\JPlag;

use App\Downloader\GitLabDownloader;
use App\Models\PlagiarismAnalysis;
use App\Models\ProjectDownload;
use App\Models\Task;
use GrahamCampbell\GitLab\GitLabManager;
use Illuminate\Support\Str;
use Storage;
use Symfony\Component\Process\Process;
use ZipArchive;

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

        if (!Storage::has("tasks/$task->id/base"))
            GitLabDownloader::downloadProject($task->source_project_id, "tasks/$task->id/base");

        $process = new Process([
            'docker',
            'run',
            '-v', Storage::path($baseDir) . ":/files",
            '-v', Storage::path($baseDir) . ":/output",
            '-v', Storage::path("tasks/$task->id/base") . ":/base",
            'jazerix/jplag:latest',
            "-n", "-1",
            "-bc", "/base",
            "-r", "/output/output",
            "/files"
        ]);
        $process->setTimeout(600);
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
                else {
                    $fileComparisons[$jplagMatch->id()] = $jplagMatch;
                    //$jplagMatch->fileSimilarity = ($match['tokens'] / ($match['file1Tokens'] + $match['file2Tokens'])) * 2;
                }

                $jplagMatch->tokensMatch += $match['tokens'];
                $jplagMatch->file1Tokens = $match['file1Tokens'];
                $jplagMatch->file2Tokens = $match['file2Tokens'];
                $jplagMatch->addOverlap($match['start1'], $match['end1'], $match['start2'], $match['end2']);
            }
            foreach(array_values($fileComparisons) as $index => $comparison) {
                $file1Parts = str($comparison->file1)->explode('/');
                $file2Parts = str($comparison->file2)->explode('/');
                $plagiarismAnalysis->fileComparisons()->create([
                    'project_1_id' => str($file1Parts->shift())->explode("_")[0],
                    'project_2_id' => str($file2Parts->shift())->explode("_")[0],
                    'filename_1'   => $file1Parts->join('/'),
                    'filename_2'   => $file2Parts->join('/'),
                    'overlap'      => $comparison->fileSimilarity(),
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
