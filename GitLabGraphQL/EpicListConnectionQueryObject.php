<?php

namespace GraphQL\SchemaObject;

class EpicListConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "EpicListConnection";

    public function selectEdges(EpicListConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new EpicListEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(EpicListConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new EpicListQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(EpicListConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
