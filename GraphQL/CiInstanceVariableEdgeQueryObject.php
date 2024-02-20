<?php

namespace GraphQL\SchemaObject;

class CiInstanceVariableEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "CiInstanceVariableEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(CiInstanceVariableEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new CiInstanceVariableQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
