<?php

namespace GraphQL\SchemaObject;

class AuditEventDefinitionEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "AuditEventDefinitionEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(AuditEventDefinitionEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new AuditEventDefinitionQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
