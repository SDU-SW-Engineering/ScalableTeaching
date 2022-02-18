<?php

namespace GraphQL\SchemaObject;

class IssueEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "IssueEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(IssueEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new IssueQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
