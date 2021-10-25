<?php

namespace GraphQL\SchemaObject;

class RequirementEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "RequirementEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(RequirementEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new RequirementQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
