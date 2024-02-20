<?php

namespace GraphQL\SchemaObject;

class CiProjectVariableQueryObject extends QueryObject
{
    const OBJECT_NAME = "CiProjectVariable";

    public function selectDescription()
    {
        $this->selectField("description");

        return $this;
    }

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
