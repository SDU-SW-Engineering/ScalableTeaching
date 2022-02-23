<?php

namespace GraphQL\SchemaObject;

class TreeConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "TreeConnection";

    public function selectEdges(TreeConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new TreeEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(TreeConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new TreeQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(TreeConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
