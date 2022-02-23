<?php

namespace GraphQL\SchemaObject;

class CiTemplateQueryObject extends QueryObject
{
    const OBJECT_NAME = "CiTemplate";

    public function selectContent()
    {
        $this->selectField("content");

        return $this;
    }

    public function selectName()
    {
        $this->selectField("name");

        return $this;
    }
}
