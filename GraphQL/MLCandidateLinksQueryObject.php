<?php

namespace GraphQL\SchemaObject;

class MLCandidateLinksQueryObject extends QueryObject
{
    const OBJECT_NAME = "MLCandidateLinks";

    public function selectArtifactPath()
    {
        $this->selectField("artifactPath");

        return $this;
    }

    public function selectShowPath()
    {
        $this->selectField("showPath");

        return $this;
    }
}
