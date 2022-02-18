<?php

namespace GraphQL\SchemaObject;

class PipelineCountsQueryObject extends QueryObject
{
    const OBJECT_NAME = "PipelineCounts";

    public function selectAll()
    {
        $this->selectField("all");

        return $this;
    }

    public function selectFinished()
    {
        $this->selectField("finished");

        return $this;
    }

    public function selectPending()
    {
        $this->selectField("pending");

        return $this;
    }

    public function selectRunning()
    {
        $this->selectField("running");

        return $this;
    }
}
