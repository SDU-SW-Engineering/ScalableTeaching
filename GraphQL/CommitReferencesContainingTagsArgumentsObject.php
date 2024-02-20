<?php

namespace GraphQL\SchemaObject;

class CommitReferencesContainingTagsArgumentsObject extends ArgumentsObject
{
    protected $excludeTipped;
    protected $limit;

    public function setExcludeTipped($excludeTipped)
    {
        $this->excludeTipped = $excludeTipped;

        return $this;
    }

    public function setLimit($limit)
    {
        $this->limit = $limit;

        return $this;
    }
}
