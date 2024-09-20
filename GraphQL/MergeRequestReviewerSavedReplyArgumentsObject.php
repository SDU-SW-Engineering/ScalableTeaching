<?php

namespace GraphQL\SchemaObject;

class MergeRequestReviewerSavedReplyArgumentsObject extends ArgumentsObject
{
    protected $id;

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
