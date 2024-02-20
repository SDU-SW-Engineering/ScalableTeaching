<?php

namespace GraphQL\SchemaObject;

class RootSyntheticNoteArgumentsObject extends ArgumentsObject
{
    protected $sha;
    protected $noteableId;

    public function setSha($sha)
    {
        $this->sha = $sha;

        return $this;
    }

    public function setNoteableId($noteableId)
    {
        $this->noteableId = $noteableId;

        return $this;
    }
}
