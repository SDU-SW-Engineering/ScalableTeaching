<?php

namespace GraphQL\SchemaObject;

class MlCandidateEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "MlCandidateEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(MlCandidateEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new MlCandidateQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
