<?php

namespace GraphQL\SchemaObject;

class ConanMetadataQueryObject extends QueryObject
{
    const OBJECT_NAME = "ConanMetadata";

    public function selectCreatedAt()
    {
        $this->selectField("createdAt");

        return $this;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectPackageChannel()
    {
        $this->selectField("packageChannel");

        return $this;
    }

    public function selectPackageUsername()
    {
        $this->selectField("packageUsername");

        return $this;
    }

    public function selectRecipe()
    {
        $this->selectField("recipe");

        return $this;
    }

    public function selectRecipePath()
    {
        $this->selectField("recipePath");

        return $this;
    }

    public function selectUpdatedAt()
    {
        $this->selectField("updatedAt");

        return $this;
    }
}
