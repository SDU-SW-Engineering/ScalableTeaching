<?php

namespace Domain\GitLab\MockedActions;

use Domain\SourceControl\Directory;
use Domain\SourceControl\DirectoryCollection;
use Domain\SourceControl\File;
use Domain\SourceControl\Group;
use Domain\SourceControl\Project;
use Domain\SourceControl\SourceControl;
use Domain\SourceControl\User;
use Faker\Factory;
use Faker\Generator;

class MockedGitlabActions implements SourceControl
{
    private Generator $factory;

    /**
     * @var Collection<int,File>
     */
    private Collection $files;

    public function __construct()
    {
        $this->factory = Factory::create();
        $this->files = new Collection();
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

    /**
     * @param  string  $projectId
     * @param  string|null  $path
     * @param  bool  $recursive
     * @param  string|null  $ref
     * @return Collection<int,File>
     */
    public function getFiles(string $projectId, string $path = null, bool $recursive = false, string $ref = null): Collection
    {
        return $this->files->filter(function (File $file) use ($path, $recursive) {
            if ($recursive) {
                return Str::of($file->getPath())->startsWith($path);
            }

            return true;
        });
    }

    /**
     * @param  Collection<int,File>  $files
     * @return void
     */
    public function fakePath(Collection $files): void
    {
        $this->files = $files;
    }

    /**
     * Produces side-effects
     *
     * @param  string  $projectId
     * @param  DirectoryCollection  $directoryCollection
     * @param  string|null  $ref
     * @return void
     */
    public function getFilesFromDirectories(string|int $projectId, DirectoryCollection $directoryCollection, string $ref = null): void
    {
        $directoryCollection->directories->reject(fn (Directory $directory) => $directory->fetched)->each(function (Directory $directory) {
            if ($directory->path == '/') {
                $directory->files = $this->files->filter(fn (File $file) => $file->getPath() == '/');
                $directory->fetched = true;

                return true;
            }
            $filesForDir = $this->files->filter(fn (File $file) => $file->getPath() == $directory->path);
            $directory->files = $filesForDir;
            $directory->fetched = true;
        });
    }

    public function addUserToProjectAs(string $projectId, string $userId, string $accessToken): void
    {
        // TODO: Implement addUserToProjectAs() method.
    }

    public function forkProject(string $sourceId, string $groupId, string $newName): ?Project
    {
        // TODO: Implement forkProject() method.
        return new Project($this->factory->randomNumber(5));
    }

    public function addUserToGroup(string|int $groupId, string|int $userId, int $level, array $options = []): void
    {

    }
}
