<?php

namespace GraphQL\SchemaObject;

class CiInstanceVariableQueryObject extends QueryObject
{
    const OBJECT_NAME = "CiInstanceVariable";

    public function selectDescription()
    {
        $this->selectField("description");

        return $this;
    }

    /**
     * @deprecated No longer used, only available for GroupVariableType and ProjectVariableType. Deprecated in 15.3.
     */
    public function selectEnvironmentScope()
    {
        $this->selectField("environmentScope");

        return $this;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectKey()
    {
        $this->selectField("key");

        return $this;
    }

    public function selectMasked()
    {
        $this->selectField("masked");

        return $this;
    }

    public function selectProtected()
    {
        $this->selectField("protected");

        return $this;
    }

    public function selectRaw()
    {
        $this->selectField("raw");

        return $this;
    }

    public function selectValue()
    {
        $this->selectField("value");

        return $this;
    }

    public function selectVariableType()
    {
        $this->selectField("variableType");

        return $this;
    }
}
