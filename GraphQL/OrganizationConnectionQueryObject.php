<?php

namespace GraphQL\SchemaObject;

class OrganizationConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "OrganizationConnection";

    public function selectEdges(OrganizationConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new OrganizationEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(OrganizationConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new OrganizationQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(OrganizationConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
