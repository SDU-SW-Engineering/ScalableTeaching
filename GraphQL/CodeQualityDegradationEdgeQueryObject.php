<?php

namespace GraphQL\SchemaObject;

class CodeQualityDegradationEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "CodeQualityDegradationEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(CodeQualityDegradationEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new CodeQualityDegradationQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
