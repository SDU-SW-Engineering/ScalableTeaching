<?php

namespace GraphQL\SchemaObject;

class SubscriptionFutureEntryEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "SubscriptionFutureEntryEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(SubscriptionFutureEntryEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new SubscriptionFutureEntryQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
