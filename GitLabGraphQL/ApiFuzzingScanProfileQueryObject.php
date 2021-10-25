<?php

namespace GraphQL\SchemaObject;

class ApiFuzzingScanProfileQueryObject extends QueryObject
{
    const OBJECT_NAME = "ApiFuzzingScanProfile";

    public function selectDescription()
    {
        $this->selectField("description");

        return $this;
    }

    public function selectName()
    {
        $this->selectField("name");

        return $this;
    }

    public function selectYaml()
    {
        $this->selectField("yaml");

        return $this;
    }
}
