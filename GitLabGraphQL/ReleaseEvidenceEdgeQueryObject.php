<?php

namespace GraphQL\SchemaObject;

class ReleaseEvidenceEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "ReleaseEvidenceEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(ReleaseEvidenceEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new ReleaseEvidenceQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
