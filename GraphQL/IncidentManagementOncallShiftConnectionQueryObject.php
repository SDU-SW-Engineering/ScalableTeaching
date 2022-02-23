<?php

namespace GraphQL\SchemaObject;

class IncidentManagementOncallShiftConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "IncidentManagementOncallShiftConnection";

    public function selectEdges(IncidentManagementOncallShiftConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new IncidentManagementOncallShiftEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(IncidentManagementOncallShiftConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new IncidentManagementOncallShiftQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(IncidentManagementOncallShiftConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
