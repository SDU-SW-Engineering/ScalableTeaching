<?php

namespace GraphQL\SchemaObject;

class ContainerExpirationPolicyQueryObject extends QueryObject
{
    const OBJECT_NAME = "ContainerExpirationPolicy";

    public function selectCadence()
    {
        $this->selectField("cadence");

        return $this;
    }

    public function selectCreatedAt()
    {
        $this->selectField("createdAt");

        return $this;
    }

    public function selectEnabled()
    {
        $this->selectField("enabled");

        return $this;
    }

    public function selectKeepN()
    {
        $this->selectField("keepN");

        return $this;
    }

    public function selectNameRegex()
    {
        $this->selectField("nameRegex");

        return $this;
    }

    public function selectNameRegexKeep()
    {
        $this->selectField("nameRegexKeep");

        return $this;
    }

    public function selectNextRunAt()
    {
        $this->selectField("nextRunAt");

        return $this;
    }

    public function selectOlderThan()
    {
        $this->selectField("olderThan");

        return $this;
    }

    public function selectUpdatedAt()
    {
        $this->selectField("updatedAt");

        return $this;
    }
}
