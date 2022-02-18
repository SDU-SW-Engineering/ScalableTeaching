<?php

namespace GraphQL\SchemaObject;

class PagesDeploymentRegistryConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "PagesDeploymentRegistryConnection";

    public function selectEdges(PagesDeploymentRegistryConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new PagesDeploymentRegistryEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(PagesDeploymentRegistryConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new PagesDeploymentRegistryQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(PagesDeploymentRegistryConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
