<?php

namespace GraphQL\SchemaObject;

class AgentMetadataQueryObject extends QueryObject
{
    const OBJECT_NAME = "AgentMetadata";

    public function selectCommit()
    {
        $this->selectField("commit");

        return $this;
    }

    public function selectPodName()
    {
        $this->selectField("podName");

        return $this;
    }

    public function selectPodNamespace()
    {
        $this->selectField("podNamespace");

        return $this;
    }

    public function selectVersion()
    {
        $this->selectField("version");

        return $this;
    }
}
