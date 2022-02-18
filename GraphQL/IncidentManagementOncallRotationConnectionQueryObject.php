<?php

namespace GraphQL\SchemaObject;

class IncidentManagementOncallRotationConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "IncidentManagementOncallRotationConnection";

    public function selectEdges(IncidentManagementOncallRotationConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new IncidentManagementOncallRotationEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(IncidentManagementOncallRotationConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new IncidentManagementOncallRotationQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(IncidentManagementOncallRotationConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
