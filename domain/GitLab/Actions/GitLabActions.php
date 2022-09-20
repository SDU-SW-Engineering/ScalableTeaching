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
        $token = User::token($user);
        $rootObject = new RootQueryObject();
        $rootObject->selectProjects((new RootProjectsArgumentsObject())
            ->setFirst(1)
            ->setIds([$id])
            ->setSearchNamespaces(true))
            ->selectNodes()
            ->selectId()
            ->selectName()
            ->selectCreatedAt()
            ->selectNamespace()->selectName()->selectFullName();
        $client = new Client(getenv('GITLAB_URL') . '/api/graphql', ["Authorization" => 'Bearer ' . $token]);

        $projects = $client->runQuery($rootObject)->getResults()->data->projects->nodes;

        if(count($projects) == 0)
            return null;
        return new Project($projects[0]->id);
    }

    public function currentUser(string $user = 'default'): User
    {
        $rootObject = new RootQueryObject();
        $rootObject->selectCurrentUser()
            ->selectName()
            ->selectId();

        $client = new Client(getenv('GITLAB_URL') . '/api/graphql', ["Authorization" => 'Bearer ' . User::token($user)]);
        $user = $client->runQuery($rootObject)->getResults()->data->currentUser;

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

    public function createGroup(string $name, array $params): ?Group
    {
        $params = (new Collection($params))
            ->merge([
                'name' => $name,
                'path' => Str::snake($name),
            ]);
        $response = Http::withToken(User::token())->baseUrl(config('sourcecontrol.url') . '/api/v4')->post('/groups', $params);
        return new Group($response->json('id'));
    }
}
