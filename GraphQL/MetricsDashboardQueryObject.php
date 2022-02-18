<?php

namespace GraphQL\SchemaObject;

class MetricsDashboardQueryObject extends QueryObject
{
    const OBJECT_NAME = "MetricsDashboard";

    public function selectAnnotations(MetricsDashboardAnnotationsArgumentsObject $argsObject = null)
    {
        $object = new MetricsDashboardAnnotationConnectionQueryObject("annotations");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPath()
    {
        $this->selectField("path");

        return $this;
    }

    public function selectSchemaValidationWarnings()
    {
        $this->selectField("schemaValidationWarnings");

        return $this;
    }
}
