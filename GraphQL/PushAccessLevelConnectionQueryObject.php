<?php

namespace GraphQL\SchemaObject;

class PushAccessLevelConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "PushAccessLevelConnection";

    public function selectEdges(PushAccessLevelConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new PushAccessLevelEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(PushAccessLevelConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new PushAccessLevelQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(PushAccessLevelConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
