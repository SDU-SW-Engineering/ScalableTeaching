<?php

namespace GraphQL\SchemaObject;

class RootBoardListArgumentsObject extends ArgumentsObject
{
    protected $id;
    protected $issueFilters;

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function setIssueFilters(BoardIssueInputInputObject $boardIssueInputInputObject)
    {
        $this->issueFilters = $boardIssueInputInputObject;

        return $this;
    }
}
