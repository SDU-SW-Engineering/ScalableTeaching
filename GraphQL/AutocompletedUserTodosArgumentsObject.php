<?php

namespace GraphQL\SchemaObject;

class AutocompletedUserTodosArgumentsObject extends ArgumentsObject
{
    protected $action;
    protected $authorId;
    protected $projectId;
    protected $groupId;
    protected $state;
    protected $type;
    protected $after;
    protected $before;
    protected $first;
    protected $last;

    public function setAction(array $action)
    {
        $this->action = $action;

        return $this;
    }

    public function setAuthorId(array $authorId)
    {
        $this->authorId = $authorId;

        return $this;
    }

    public function setProjectId(array $projectId)
    {
        $this->projectId = $projectId;

        return $this;
    }

    public function setGroupId(array $groupId)
    {
        $this->groupId = $groupId;

        return $this;
    }

    public function setState(array $state)
    {
        $this->state = $state;

        return $this;
    }

    public function setType(array $type)
    {
        $this->type = $type;

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
