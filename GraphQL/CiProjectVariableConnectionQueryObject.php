<?php

namespace GraphQL\SchemaObject;

class CiProjectVariableConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "CiProjectVariableConnection";

    public function selectEdges(CiProjectVariableConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new CiProjectVariableEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectLimit()
    {
        $this->selectField("limit");

        return $this;
    }

    public function selectNodes(CiProjectVariableConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new CiProjectVariableQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(CiProjectVariableConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
