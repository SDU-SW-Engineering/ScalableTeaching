<?php

namespace GraphQL\SchemaObject;

class DoraQueryObject extends QueryObject
{
    const OBJECT_NAME = "Dora";

    public function selectMetrics(DoraMetricsArgumentsObject $argsObject = null)
    {
        $object = new DoraMetricQueryObject("metrics");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
