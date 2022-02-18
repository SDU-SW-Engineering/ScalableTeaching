<?php

namespace GraphQL\SchemaObject;

class MilestoneEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "MilestoneEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(MilestoneEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new MilestoneQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
