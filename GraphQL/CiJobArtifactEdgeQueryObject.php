<?php

namespace GraphQL\SchemaObject;

class CiJobArtifactEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "CiJobArtifactEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(CiJobArtifactEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new CiJobArtifactQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
