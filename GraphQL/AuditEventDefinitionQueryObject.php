<?php

namespace GraphQL\SchemaObject;

class AuditEventDefinitionQueryObject extends QueryObject
{
    const OBJECT_NAME = "AuditEventDefinition";

    public function selectDescription()
    {
        $this->selectField("description");

        return $this;
    }

    public function selectFeatureCategory()
    {
        $this->selectField("featureCategory");

        return $this;
    }

    public function selectIntroducedByIssue()
    {
        $this->selectField("introducedByIssue");

        return $this;
    }

    public function selectIntroducedByMr()
    {
        $this->selectField("introducedByMr");

        return $this;
    }

    public function selectMilestone()
    {
        $this->selectField("milestone");

        return $this;
    }

    public function selectName()
    {
        $this->selectField("name");

        return $this;
    }

    public function selectSavedToDatabase()
    {
        $this->selectField("savedToDatabase");

        return $this;
    }

    public function selectStreamed()
    {
        $this->selectField("streamed");

        return $this;
    }
}
