<?php

namespace GraphQL\SchemaObject;

class ExternalAuditEventDestinationConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "ExternalAuditEventDestinationConnection";

    public function selectEdges(ExternalAuditEventDestinationConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new ExternalAuditEventDestinationEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(ExternalAuditEventDestinationConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new ExternalAuditEventDestinationQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(ExternalAuditEventDestinationConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
