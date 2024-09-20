<?php

namespace GraphQL\SchemaObject;

class ValueStreamConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "ValueStreamConnection";

    public function selectEdges(ValueStreamConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new ValueStreamEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(ValueStreamConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new ValueStreamQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(ValueStreamConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
