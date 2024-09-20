<?php

namespace GraphQL\SchemaObject;

class CiProjectVariableEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "CiProjectVariableEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(CiProjectVariableEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new CiProjectVariableQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
