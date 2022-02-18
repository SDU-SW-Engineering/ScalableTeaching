<?php

namespace GraphQL\SchemaObject;

class MergeRequestDiffRegistryConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "MergeRequestDiffRegistryConnection";

    public function selectEdges(MergeRequestDiffRegistryConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new MergeRequestDiffRegistryEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(MergeRequestDiffRegistryConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new MergeRequestDiffRegistryQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(MergeRequestDiffRegistryConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
