<?php

namespace GraphQL\SchemaObject;

class AuditEventDefinitionConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "AuditEventDefinitionConnection";

    public function selectEdges(AuditEventDefinitionConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new AuditEventDefinitionEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(AuditEventDefinitionConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new AuditEventDefinitionQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(AuditEventDefinitionConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
