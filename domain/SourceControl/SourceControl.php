<?php

namespace Domain\SourceControl;

interface SourceControl
{
    public function showProject(string $id, string $user = 'default'): ?Project;

    public function currentUser(string $user = 'default'): User;

    public function addUserToProject(string $projectId, string $userId): void;

    public function createGroup(string $name, array $params): ?Group;
}
