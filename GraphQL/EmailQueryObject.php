<?php

namespace GraphQL\SchemaObject;

class EmailQueryObject extends QueryObject
{
    const OBJECT_NAME = "Email";

    public function selectConfirmedAt()
    {
        $this->selectField("confirmedAt");

        return $this;
    }

    public function selectCreatedAt()
    {
        $this->selectField("createdAt");

        return $this;
    }

    public function selectEmail()
    {
        $this->selectField("email");

        return $this;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectUpdatedAt()
    {
        $this->selectField("updatedAt");

        return $this;
    }
}
