<?php

namespace GraphQL\SchemaObject;

class CiGroupVariableEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "CiGroupVariableEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(CiGroupVariableEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new CiGroupVariableQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
