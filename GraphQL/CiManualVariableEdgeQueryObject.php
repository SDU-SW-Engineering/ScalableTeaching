<?php

namespace GraphQL\SchemaObject;

class CiManualVariableEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "CiManualVariableEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(CiManualVariableEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new CiManualVariableQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
