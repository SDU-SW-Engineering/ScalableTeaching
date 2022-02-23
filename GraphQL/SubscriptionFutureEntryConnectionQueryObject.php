<?php

namespace GraphQL\SchemaObject;

class SubscriptionFutureEntryConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "SubscriptionFutureEntryConnection";

    public function selectEdges(SubscriptionFutureEntryConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new SubscriptionFutureEntryEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(SubscriptionFutureEntryConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new SubscriptionFutureEntryQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(SubscriptionFutureEntryConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
