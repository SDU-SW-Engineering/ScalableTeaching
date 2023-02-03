<?php

namespace Domain\SourceControl;

use Illuminate\Support\Collection;

interface SourceControl
{
    /**
     * @param  Collection<int,File>  $files
     * @return void
     */
    public function fakePath(Collection $files): void;

    public function showProject(string $id, string $user = 'default'): ?Project;

    public function currentUser(string $user = 'default'): User;

    public function addUserToProject(string $projectId, string $userId): void;

    public function addUserToProjectAs(string $projectId, string $userId, string $accessToken): void;

    public function addUserToGroup(string|int $groupId, string|int $userId, int $level, array $options = []): void;

    public function createGroup(string $name, array $params): ?Group;

    public function forkProject(string $sourceId, string $groupId, string $newName): ?Project;

    /**
     * @param  string  $projectId
     * @param  DirectoryCollection  $directoryCollection
     * @param  string|null  $ref
     * @return void
     */
    public function getFilesFromDirectories(string|int $projectId, DirectoryCollection $directoryCollection, string $ref = null): void;
}
