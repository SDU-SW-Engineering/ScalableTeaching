<?php

namespace GraphQL\SchemaObject;

class CommitReferencesTippingTagsArgumentsObject extends ArgumentsObject
{
    protected $limit;

    public function setLimit($limit)
    {
        $this->limit = $limit;

        return $this;
    }
}
