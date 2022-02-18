<?php

namespace GraphQL\SchemaObject;

class CustomerRelationsOrganizationQueryObject extends QueryObject
{
    const OBJECT_NAME = "CustomerRelationsOrganization";

    public function selectCreatedAt()
    {
        $this->selectField("createdAt");

        return $this;
    }

    public function selectDefaultRate()
    {
        $this->selectField("defaultRate");

        return $this;
    }

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

    public function selectName()
    {
        $this->selectField("name");

        return $this;
    }

    public function selectUpdatedAt()
    {
        $this->selectField("updatedAt");

        return $this;
    }
}
