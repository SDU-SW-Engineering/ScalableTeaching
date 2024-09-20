<?php

namespace GraphQL\SchemaObject;

class InheritedCiVariableQueryObject extends QueryObject
{
    const OBJECT_NAME = "InheritedCiVariable";

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

    public function selectGroupCiCdSettingsPath()
    {
        $this->selectField("groupCiCdSettingsPath");

        return $this;
    }

    public function selectGroupName()
    {
        $this->selectField("groupName");

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

    public function selectVariableType()
    {
        $this->selectField("variableType");

        return $this;
    }
}
