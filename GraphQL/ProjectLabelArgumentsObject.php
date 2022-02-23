<?php

namespace GraphQL\SchemaObject;

class ProjectLabelArgumentsObject extends ArgumentsObject
{
    protected $title;

    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }
}
