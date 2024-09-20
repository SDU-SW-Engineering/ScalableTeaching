<?php

namespace GraphQL\SchemaObject;

class InheritedCiVariableEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "InheritedCiVariableEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(InheritedCiVariableEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new InheritedCiVariableQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
