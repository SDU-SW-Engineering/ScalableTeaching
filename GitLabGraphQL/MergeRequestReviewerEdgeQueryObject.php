<?php

namespace GraphQL\SchemaObject;

class MergeRequestReviewerEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "MergeRequestReviewerEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(MergeRequestReviewerEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new MergeRequestReviewerQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
