<?php

namespace GraphQL\SchemaObject;

class MergeRequestParticipantEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "MergeRequestParticipantEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(MergeRequestParticipantEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new MergeRequestParticipantQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
