<?php

namespace GraphQL\SchemaObject;

class TimelogConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "TimelogConnection";

    public function selectEdges(TimelogConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new TimelogEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(TimelogConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new TimelogQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(TimelogConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
