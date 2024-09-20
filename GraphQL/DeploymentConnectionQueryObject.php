<?php

namespace GraphQL\SchemaObject;

class DeploymentConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "DeploymentConnection";

    public function selectEdges(DeploymentConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new DeploymentEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(DeploymentConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new DeploymentQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(DeploymentConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
