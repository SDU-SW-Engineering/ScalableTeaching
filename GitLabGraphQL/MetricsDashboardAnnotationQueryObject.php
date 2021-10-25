<?php

namespace GraphQL\SchemaObject;

class MetricsDashboardAnnotationQueryObject extends QueryObject
{
    const OBJECT_NAME = "MetricsDashboardAnnotation";

    public function selectDescription()
    {
        $this->selectField("description");

        return $this;
    }

    public function selectEndingAt()
    {
        $this->selectField("endingAt");

        return $this;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectPanelId()
    {
        $this->selectField("panelId");

        return $this;
    }

    public function selectStartingAt()
    {
        $this->selectField("startingAt");

        return $this;
    }
}
