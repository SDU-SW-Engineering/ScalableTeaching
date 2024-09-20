<?php

namespace GraphQL\SchemaObject;

class ProjectAutocompleteUsersArgumentsObject extends ArgumentsObject
{
    protected $search;

    public function setSearch($search)
    {
        $this->search = $search;

        return $this;
    }
}
