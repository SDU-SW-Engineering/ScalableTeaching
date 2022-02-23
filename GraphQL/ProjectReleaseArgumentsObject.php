<?php

namespace GraphQL\SchemaObject;

class ProjectReleaseArgumentsObject extends ArgumentsObject
{
    protected $tagName;

    public function setTagName($tagName)
    {
        $this->tagName = $tagName;

        return $this;
    }
}
