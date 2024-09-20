<?php

namespace GraphQL\SchemaObject;

class DeploymentTagQueryObject extends QueryObject
{
    const OBJECT_NAME = "DeploymentTag";

    public function selectName()
    {
        $this->selectField("name");

        return $this;
    }

    public function selectPath()
    {
        $this->selectField("path");

        return $this;
    }
}
