<?php

namespace Domain\GitLab\Actions;

use Domain\SourceControl\Group;
use Domain\SourceControl\Project;
use Domain\SourceControl\SourceControl;
use Domain\SourceControl\User;
use GraphQL\Client;
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

    private static function gidToId(string $id): string
    {
        return Str::of($id)->split('#/#')->last();
    }

    private static function idToGid(string|int $id) : string
    {
        $id = Str::of($id);
        if ($id->contains('gid://gitlab/Project/'))
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
}
