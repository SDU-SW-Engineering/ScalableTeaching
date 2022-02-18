<?php

namespace GraphQL\SchemaObject;

class SentryErrorConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "SentryErrorConnection";

    public function selectEdges(SentryErrorConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new SentryErrorEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(SentryErrorConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new SentryErrorQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(SentryErrorConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
