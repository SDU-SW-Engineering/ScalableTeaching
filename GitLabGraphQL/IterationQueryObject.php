<?php

namespace GraphQL\SchemaObject;

class IterationQueryObject extends QueryObject
{
    const OBJECT_NAME = "Iteration";

    public function selectCreatedAt()
    {
        $this->selectField("createdAt");

        return $this;
    }

    public function selectDescription()
    {
        $this->selectField("description");

        return $this;
    }

    public function selectDescriptionHtml()
    {
        $this->selectField("descriptionHtml");

        return $this;
    }

    public function selectDueDate()
    {
        $this->selectField("dueDate");

        return $this;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectIid()
    {
        $this->selectField("iid");

        return $this;
    }

    public function selectIterationCadence(IterationIterationCadenceArgumentsObject $argsObject = null)
    {
        $object = new IterationCadenceQueryObject("iterationCadence");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectReport(IterationReportArgumentsObject $argsObject = null)
    {
        $object = new TimeboxReportQueryObject("report");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectScopedPath()
    {
        $this->selectField("scopedPath");

        return $this;
    }

    public function selectScopedUrl()
    {
        $this->selectField("scopedUrl");

        return $this;
    }

    public function selectStartDate()
    {
        $this->selectField("startDate");

        return $this;
    }

    public function selectState()
    {
        $this->selectField("state");

        return $this;
    }

    public function selectTitle()
    {
        $this->selectField("title");

        return $this;
    }

    public function selectUpdatedAt()
    {
        $this->selectField("updatedAt");

        return $this;
    }

    public function selectWebPath()
    {
        $this->selectField("webPath");

        return $this;
    }

    public function selectWebUrl()
    {
        $this->selectField("webUrl");

        return $this;
    }
}
