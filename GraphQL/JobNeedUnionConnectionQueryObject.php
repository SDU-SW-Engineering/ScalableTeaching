<?php

namespace GraphQL\SchemaObject;

class JobNeedUnionConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "JobNeedUnionConnection";

    public function selectEdges(JobNeedUnionConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new JobNeedUnionEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(JobNeedUnionConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new JobNeedUnionUnionObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(JobNeedUnionConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
