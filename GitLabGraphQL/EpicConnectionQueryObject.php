<?php

namespace GraphQL\SchemaObject;

class EpicConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "EpicConnection";

    public function selectEdges(EpicConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new EpicEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(EpicConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new EpicQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(EpicConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
