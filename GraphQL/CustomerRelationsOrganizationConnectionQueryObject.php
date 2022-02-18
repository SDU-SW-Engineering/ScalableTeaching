<?php

namespace GraphQL\SchemaObject;

class CustomerRelationsOrganizationConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "CustomerRelationsOrganizationConnection";

    public function selectEdges(CustomerRelationsOrganizationConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new CustomerRelationsOrganizationEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(CustomerRelationsOrganizationConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new CustomerRelationsOrganizationQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(CustomerRelationsOrganizationConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
