<?php

namespace GraphQL\SchemaObject;

class EgressNodeQueryObject extends QueryObject
{
    const OBJECT_NAME = "EgressNode";

    public function selectArtifactsEgress()
    {
        $this->selectField("artifactsEgress");

        return $this;
    }

    public function selectDate()
    {
        $this->selectField("date");

        return $this;
    }

    public function selectPackagesEgress()
    {
        $this->selectField("packagesEgress");

        return $this;
    }

    public function selectRegistryEgress()
    {
        $this->selectField("registryEgress");

        return $this;
    }

    public function selectRepositoryEgress()
    {
        $this->selectField("repositoryEgress");

        return $this;
    }

    public function selectTotalEgress()
    {
        $this->selectField("totalEgress");

        return $this;
    }
}
