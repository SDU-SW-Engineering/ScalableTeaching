<?php

namespace GraphQL\SchemaObject;

class ComplianceFrameworkConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "ComplianceFrameworkConnection";

    public function selectEdges(ComplianceFrameworkConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new ComplianceFrameworkEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(ComplianceFrameworkConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new ComplianceFrameworkQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(ComplianceFrameworkConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
