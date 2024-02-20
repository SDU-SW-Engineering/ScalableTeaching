<?php

namespace GraphQL\SchemaObject;

class CiInstanceVariableConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "CiInstanceVariableConnection";

    public function selectEdges(CiInstanceVariableConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new CiInstanceVariableEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(CiInstanceVariableConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new CiInstanceVariableQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(CiInstanceVariableConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
