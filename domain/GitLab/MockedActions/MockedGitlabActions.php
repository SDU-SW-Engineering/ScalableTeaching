<?php

namespace Domain\GitLab\MockedActions;

use Domain\SourceControl\Group;
use Domain\SourceControl\Project;
use Domain\SourceControl\SourceControl;
use Domain\SourceControl\User;
use Faker\Factory;
use Faker\Generator;

class MockedGitlabActions implements SourceControl
{
    private Generator $factory;

    public function __construct()
    {
        $this->factory = Factory::create();
    }

    public function showProject(string $id, string $user = 'default'): ?Project
    {
        return new Project($this->factory->randomNumber(4));
    }

    public function currentUser(string $user = 'default'): User
    {
        return new User($this->factory->randomNumber(4), $this->factory->name);
    }

    public function addUserToProject(string $projectId, string $userId): void
    {

    }

    public function createGroup(string $name, array $params): ?Group
    {
        return new Group($this->factory->randomNumber(4));
    }
}
