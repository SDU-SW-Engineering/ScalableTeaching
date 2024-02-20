<?php

namespace GraphQL\SchemaObject;

class ProjectCommitReferencesArgumentsObject extends ArgumentsObject
{
    protected $commitSha;

    public function setCommitSha($commitSha)
    {
        $this->commitSha = $commitSha;

        return $this;
    }
}
