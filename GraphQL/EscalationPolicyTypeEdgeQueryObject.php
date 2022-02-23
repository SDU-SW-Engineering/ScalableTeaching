<?php

namespace GraphQL\SchemaObject;

class EscalationPolicyTypeEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "EscalationPolicyTypeEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(EscalationPolicyTypeEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new EscalationPolicyTypeQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
