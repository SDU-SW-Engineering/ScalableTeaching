<?php

namespace GraphQL\SchemaObject;

class OncallParticipantTypeEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "OncallParticipantTypeEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(OncallParticipantTypeEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new OncallParticipantTypeQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
