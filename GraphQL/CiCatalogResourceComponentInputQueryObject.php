<?php

namespace GraphQL\SchemaObject;

class CiCatalogResourceComponentInputQueryObject extends QueryObject
{
    const OBJECT_NAME = "CiCatalogResourceComponentInput";

    /**
     * @deprecated **Status**: Experiment. Introduced in 16.7.
     */
    public function selectDefault()
    {
        $this->selectField("default");

        return $this;
    }

    /**
     * @deprecated **Status**: Experiment. Introduced in 16.7.
     */
    public function selectName()
    {
        $this->selectField("name");

        return $this;
    }

    /**
     * @deprecated **Status**: Experiment. Introduced in 16.7.
     */
    public function selectRequired()
    {
        $this->selectField("required");

        return $this;
    }
}
