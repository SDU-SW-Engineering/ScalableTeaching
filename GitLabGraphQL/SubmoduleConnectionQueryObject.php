<?php

namespace GraphQL\SchemaObject;

class SubmoduleConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "SubmoduleConnection";

    public function selectEdges(SubmoduleConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new SubmoduleEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(SubmoduleConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new SubmoduleQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(SubmoduleConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
