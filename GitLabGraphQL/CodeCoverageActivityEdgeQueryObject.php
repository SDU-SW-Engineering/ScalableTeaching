<?php

namespace GraphQL\SchemaObject;

class CodeCoverageActivityEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "CodeCoverageActivityEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(CodeCoverageActivityEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new CodeCoverageActivityQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
