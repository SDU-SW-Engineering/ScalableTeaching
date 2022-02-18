<?php

namespace GraphQL\SchemaObject;

class ContainerRepositoryTagConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "ContainerRepositoryTagConnection";

    public function selectEdges(ContainerRepositoryTagConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new ContainerRepositoryTagEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(ContainerRepositoryTagConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new ContainerRepositoryTagQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(ContainerRepositoryTagConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
