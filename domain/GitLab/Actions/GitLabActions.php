<?php

namespace Domain\GitLab\Actions;

use Domain\SourceControl\Directory;
use Domain\SourceControl\DirectoryCollection;
use Domain\SourceControl\File;
use Domain\SourceControl\Group;
use Domain\SourceControl\Project;
use Domain\SourceControl\SourceControl;
use Domain\SourceControl\User;
use Exception;
use GraphQL\Client;
use GraphQL\SchemaObject\RepositoryTreeArgumentsObject;
use GraphQL\SchemaObject\RootProjectsArgumentsObject;
use GraphQL\SchemaObject\RootQueryObject;
use Http;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class GitLabActions implements SourceControl
{
    public function showProject(string $id, string $user = 'default'): ?Project
    {
        $id = self::idToGid($id);
        $token = User::token($user);
        $rootObject = new RootQueryObject();
        $nodeSelector = $rootObject->selectProjects((new RootProjectsArgumentsObject())
            ->setFirst(1)
            ->setIds([$id])
            ->setSearchNamespaces(true))
            ->selectNodes();

        $nodeSelector
            ->selectId()
            ->selectName()
            ->selectHttpUrlToRepo()
            ->selectCreatedAt()
            ->selectNamespace()->selectName()->selectFullName();
        $nodeSelector->selectRepository()
            ->selectTree()
            ->selectLastCommit()
            ->selectSha();
        $client = new Client(getenv('GITLAB_URL') . '/api/graphql', ["Authorization" => 'Bearer ' . $token]);

        $projects = $client->runQuery($rootObject)->getResults()->data->projects->nodes; // @phpstan-ignore-line
        if(count($projects) == 0)
            return null;

        $project = new Project($projects[0]->id);
        $project->lastSha = $projects[0]->repository->tree->lastCommit->sha;
        $project->cloneUrl = $projects[0]->httpUrlToRepo;

        return $project;
    }

    public function currentUser(string $user = 'default'): User
    {
        $rootObject = new RootQueryObject();
        $rootObject->selectCurrentUser()
            ->selectName()
            ->selectId();

        $client = new Client(getenv('GITLAB_URL') . '/api/graphql', ["Authorization" => 'Bearer ' . User::token($user)]);
        $user = $client->runQuery($rootObject)->getResults()->data->currentUser; // @phpstan-ignore-line

        return new User($user->id, $user->name);
    }

    public function addUserToProject(string $projectId, string $userId): void
    {
        $response = Http::withToken(User::token())->baseUrl(config('sourcecontrol.url') . '/api/v4')->post('/projects/' . self::gidToId($projectId), [
            'user_id'      => self::gidToId($userId),
            'access_level' => 40,
        ]);
    }

    /**
     * @param string $projectId
     * @param string $userId
     * @param string $as Access token for the user to perform the action as
     * @return void
     */
    public function addUserToProjectAs(string $projectId, string $userId, string $as): void
    {
        $response = Http::withToken($as)->baseUrl(config('sourcecontrol.url') . '/api/v4')->post('/projects/' . self::gidToId($projectId) . '/members', [
            'user_id'      => self::gidToId($userId),
            'access_level' => 40,
        ]);
    }

    private static function gidToId(string $id): string
    {
        return Str::of($id)->split('#/#')->last();
    }

    private static function idToGid(string|int $id): string
    {
        $id = Str::of($id);
        if($id->contains('gid://gitlab/Project/'))
            return $id;

        return $id->prepend('gid://gitlab/Project/');
    }

    public function createGroup(string $name, array $params): ?Group
    {
        $params = (new Collection($params))
            ->merge([
                'name' => $name,
                'path' => Str::snake($name),
            ]);
        $response = Http::withToken(User::token())->baseUrl(config('sourcecontrol.url') . '/api/v4')->post('/groups', $params->toArray());
        return new Group($response->json('id'));
    }

    /**
     * @throws Exception
     */
    public function fakePath(Collection $files): void
    {
        throw new Exception("Can't fake prod ready file.");
    }

    public function getFilesFromDirectories(string $projectId, DirectoryCollection $directoryCollection, string $ref = null): void
    {
        $rootObject = new RootQueryObject();
        $repository = $rootObject->selectProjects((new RootProjectsArgumentsObject())
            ->setIds([self::idToGid($projectId)])
            ->setFirst(1))
            ->selectNodes()
            ->selectRepository();

        $directoryCollection->directories->reject(fn(Directory $directory) => $directory->fetched)->each(function(Directory $directory) use ($repository) {
            $path = $directory->graphQlSanitized()->toString();
            $repository
                ->selectTree(
                    (new RepositoryTreeArgumentsObject())->setPath($path)
                )->setAlias($directory->graphQlSanitized()->replace('/', '_'))
                ->selectBlobs()
                ->selectNodes()
                ->selectName()
                ->selectSha();
        });
        $client = new Client(getenv('GITLAB_URL') . '/api/graphql', ["Authorization" => 'Bearer ' . config('scalable.gitlab_token')]);
        $directoryAndFiles = (array)$client->runQuery($rootObject)->getResults()->data->projects->nodes[0]->repository; // @phpstan-ignore-line
        $directoryCollection->directories->reject(fn(Directory $directory) => $directory->fetched)->each(function(Directory $directory) use ($directoryAndFiles) {
            $queryPath = $directory->graphQlSanitized()->replace("/", "_")->toString();
            foreach($directoryAndFiles[$queryPath]->blobs->nodes as $file) {
                $directory->files[] = new File($directory->path, $file->name, $file->sha);
                $directory->fetched = true;
            }
        });
    }

    public function forkProject(string $sourceId, string $groupId, string $newName): ?Project
    {
        $params = [
            'namespace_id' => $groupId,
            'name'         => $newName
        ];
        $response = Http::withToken(User::token())->baseUrl(config('sourcecontrol.url') . '/api/v4')->post("/projects/$sourceId/fork", $params);
        return new Project($response->json('id'));
    }
}
