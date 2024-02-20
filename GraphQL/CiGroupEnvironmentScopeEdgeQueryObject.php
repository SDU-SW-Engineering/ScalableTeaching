<?php

namespace GraphQL\SchemaObject;

class CiGroupEnvironmentScopeEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "CiGroupEnvironmentScopeEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(CiGroupEnvironmentScopeEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new CiGroupEnvironmentScopeQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
