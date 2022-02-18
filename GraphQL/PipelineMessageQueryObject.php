<?php

namespace GraphQL\SchemaObject;

class PipelineMessageQueryObject extends QueryObject
{
    const OBJECT_NAME = "PipelineMessage";

    public function selectContent()
    {
        $this->selectField("content");

        return $this;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }
}
