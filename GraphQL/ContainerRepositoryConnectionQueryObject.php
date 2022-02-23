<?php

namespace GraphQL\SchemaObject;

class ContainerRepositoryConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "ContainerRepositoryConnection";

    public function selectEdges(ContainerRepositoryConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new ContainerRepositoryEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(ContainerRepositoryConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new ContainerRepositoryQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(ContainerRepositoryConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
