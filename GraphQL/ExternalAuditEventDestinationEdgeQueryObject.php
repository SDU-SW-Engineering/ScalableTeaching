<?php

namespace GraphQL\SchemaObject;

class ExternalAuditEventDestinationEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "ExternalAuditEventDestinationEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(ExternalAuditEventDestinationEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new ExternalAuditEventDestinationQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
