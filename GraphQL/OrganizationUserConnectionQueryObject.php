<?php

namespace GraphQL\SchemaObject;

class OrganizationUserConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "OrganizationUserConnection";

    public function selectEdges(OrganizationUserConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new OrganizationUserEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(OrganizationUserConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new OrganizationUserQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(OrganizationUserConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
