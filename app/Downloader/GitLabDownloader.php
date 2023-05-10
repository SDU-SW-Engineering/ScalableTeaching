<?php

namespace App\Downloader;

use GrahamCampbell\GitLab\GitLabManager;
use Storage;
use ZipArchive;

class GitLabDownloader
{
    public static function downloadProject(int $projectId, $saveTo, $ref = null): bool
    {
        try {
            $gitLabManager = app(GitLabManager::class);

            $argument = $ref == null ? [] : ['sha' => $ref];
            $archiveContent = $gitLabManager->repositories()->archive($projectId, [
                ...$argument
            ], 'zip');

            if(!Storage::exists("temp"))
                Storage::createDirectory("temp");
            $tempName = "temp" . str()->random(4);
            $fileLocation = "temp/$tempName.zip";
            Storage::disk('local')->put($fileLocation, $archiveContent);

            $zip = new ZipArchive();
            $zip->open(Storage::path($fileLocation));
            $zipBaseDir = $zip->getNameIndex(0);
            $zip->extractTo(Storage::path("temp"));
            Storage::move("temp/$zipBaseDir", $saveTo);
            Storage::delete($fileLocation);
            return true;
        } catch(\Exception $exception) {
            return false;
        }
    }
}
