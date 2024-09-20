<?php

namespace GraphQL\SchemaObject;

class ProjectEnvironmentArgumentsObject extends ArgumentsObject
{
    protected $name;
    protected $search;
    protected $states;
    protected $type;

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function setSearch($search)
    {
        $this->search = $search;

        return $this;
    }

    public function setStates(array $states)
    {
        $this->states = $states;

        return $this;
    }

    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }
}
