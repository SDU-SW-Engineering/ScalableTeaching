<?php

namespace GraphQL\SchemaObject;

class ComplianceFrameworkEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "ComplianceFrameworkEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(ComplianceFrameworkEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new ComplianceFrameworkQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
