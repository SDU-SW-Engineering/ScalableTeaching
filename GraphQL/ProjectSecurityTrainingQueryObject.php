<?php

namespace GraphQL\SchemaObject;

class ProjectSecurityTrainingQueryObject extends QueryObject
{
    const OBJECT_NAME = "ProjectSecurityTraining";

    public function selectDescription()
    {
        $this->selectField("description");

        return $this;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectIsEnabled()
    {
        $this->selectField("isEnabled");

        return $this;
    }

    public function selectIsPrimary()
    {
        $this->selectField("isPrimary");

        return $this;
    }

    public function selectLogoUrl()
    {
        $this->selectField("logoUrl");

        return $this;
    }

    public function selectName()
    {
        $this->selectField("name");

        return $this;
    }

    public function selectUrl()
    {
        $this->selectField("url");

        return $this;
    }
}
