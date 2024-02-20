<?php

namespace GraphQL\SchemaObject;

class ValueStreamAnalyticsMetricQueryObject extends QueryObject
{
    const OBJECT_NAME = "ValueStreamAnalyticsMetric";

    public function selectIdentifier()
    {
        $this->selectField("identifier");

        return $this;
    }

    public function selectLinks(ValueStreamAnalyticsMetricLinksArgumentsObject $argsObject = null)
    {
        $object = new ValueStreamMetricLinkTypeQueryObject("links");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTitle()
    {
        $this->selectField("title");

        return $this;
    }

    public function selectUnit()
    {
        $this->selectField("unit");

        return $this;
    }

    public function selectValue()
    {
        $this->selectField("value");

        return $this;
    }
}
