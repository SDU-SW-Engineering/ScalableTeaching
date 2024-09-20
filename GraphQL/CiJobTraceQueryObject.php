<?php

namespace GraphQL\SchemaObject;

class CiJobTraceQueryObject extends QueryObject
{
    const OBJECT_NAME = "CiJobTrace";

    /**
     * @deprecated **Status**: Experiment. Introduced in 15.11.
     */
    public function selectHtmlSummary()
    {
        $this->selectField("htmlSummary");

        return $this;
    }
}
