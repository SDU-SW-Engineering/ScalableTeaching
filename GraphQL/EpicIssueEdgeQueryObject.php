<?php

namespace GraphQL\SchemaObject;

class EpicIssueEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "EpicIssueEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(EpicIssueEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new EpicIssueQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
