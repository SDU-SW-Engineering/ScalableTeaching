<?php

namespace GraphQL\SchemaObject;

class GroupLabelArgumentsObject extends ArgumentsObject
{
    protected $title;

    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }
}
