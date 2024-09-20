<?php

namespace GraphQL\SchemaObject;

use GraphQL\RawObject;

class CommitPipelinesArgumentsObject extends ArgumentsObject
{
    protected $status;
    protected $scope;
    protected $ref;
    protected $sha;
    protected $source;
    protected $updatedAfter;
    protected $updatedBefore;
    protected $username;
    protected $after;
    protected $before;
    protected $first;
    protected $last;

    public function setStatus($pipelineStatusEnum)
    {
        $this->status = new RawObject($pipelineStatusEnum);

        return $this;
    }

    public function setScope($pipelineScopeEnum)
    {
        $this->scope = new RawObject($pipelineScopeEnum);

        return $this;
    }

    public function setRef($ref)
    {
        $this->ref = $ref;

        return $this;
    }

    public function setSha($sha)
    {
        $this->sha = $sha;

        return $this;
    }

    public function setSource($source)
    {
        $this->source = $source;

        return $this;
    }

    public function setUpdatedAfter($updatedAfter)
    {
        $this->updatedAfter = $updatedAfter;

        return $this;
    }

    public function setUpdatedBefore($updatedBefore)
    {
        $this->updatedBefore = $updatedBefore;

        return $this;
    }

    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    public function setAfter($after)
    {
        $this->after = $after;

        return $this;
    }

    public function setBefore($before)
    {
        $this->before = $before;

        return $this;
    }

    public function setFirst($first)
    {
        $this->first = $first;

        return $this;
    }

    public function setLast($last)
    {
        $this->last = $last;

        return $this;
    }
}
