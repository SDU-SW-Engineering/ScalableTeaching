<?php

namespace GraphQL\SchemaObject;

class IncidentManagementOncallScheduleConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "IncidentManagementOncallScheduleConnection";

    public function selectEdges(IncidentManagementOncallScheduleConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new IncidentManagementOncallScheduleEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(IncidentManagementOncallScheduleConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new IncidentManagementOncallScheduleQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(IncidentManagementOncallScheduleConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
