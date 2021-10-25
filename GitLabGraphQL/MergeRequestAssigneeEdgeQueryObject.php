<?php

namespace GraphQL\SchemaObject;

class MergeRequestAssigneeEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "MergeRequestAssigneeEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(MergeRequestAssigneeEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new MergeRequestAssigneeQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
