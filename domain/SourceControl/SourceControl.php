<?php

namespace Domain\SourceControl;

use Illuminate\Support\Collection;

interface SourceControl
{
    /**
     * @param Collection<int,File> $files
     * @return void
     */
    public function fakePath(Collection $files): void;

    public function showProject(string $id, string $user = 'default') : ?Project;

    public function currentUser(string $user = 'default') : User;

    public function addUserToProject(string $projectId, string $userId) : void;

    public function createGroup(string $name, array $params) : ?Group;

    /**
     * @param string $projectId
     * @param DirectoryCollection $directoryCollection
     * @param string|null $ref
     * @return void
     */
    public function getFilesFromDirectories(string $projectId, DirectoryCollection $directoryCollection, string $ref = null) : void;
}
