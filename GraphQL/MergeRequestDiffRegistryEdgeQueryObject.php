<?php

namespace GraphQL\SchemaObject;

class MergeRequestDiffRegistryEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "MergeRequestDiffRegistryEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(MergeRequestDiffRegistryEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new MergeRequestDiffRegistryQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
