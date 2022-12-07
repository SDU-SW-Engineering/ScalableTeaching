<?php

namespace Domain\SourceControl;

use Illuminate\Support\Collection;

interface SourceControl
{
    /**
     * @param Collection<File> $files
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
     * @param bool $recursive
     * @param string|null $ref
     * @return void
     */
    public function getFilesFromDirectories(string $projectId, DirectoryCollection $directoryCollection, bool $recursive = false, string $ref = null) : void;
}
