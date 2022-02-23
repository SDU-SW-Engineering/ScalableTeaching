<?php

namespace GraphQL\SchemaObject;

class EscalationPolicyTypeConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "EscalationPolicyTypeConnection";

    public function selectEdges(EscalationPolicyTypeConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new EscalationPolicyTypeEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(EscalationPolicyTypeConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new EscalationPolicyTypeQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(EscalationPolicyTypeConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
