<?php

namespace GraphQL\SchemaObject;

class ReleaseEvidenceQueryObject extends QueryObject
{
    const OBJECT_NAME = "ReleaseEvidence";

    public function selectCollectedAt()
    {
        $this->selectField("collectedAt");

        return $this;
    }

    public function selectFilepath()
    {
        $this->selectField("filepath");

        return $this;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectSha()
    {
        $this->selectField("sha");

        return $this;
    }
}
