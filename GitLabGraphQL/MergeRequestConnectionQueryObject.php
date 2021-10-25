<?php

namespace GraphQL\SchemaObject;

class MergeRequestConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "MergeRequestConnection";

    public function selectCount()
    {
        $this->selectField("count");

        return $this;
    }

    public function selectEdges(MergeRequestConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new MergeRequestEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(MergeRequestConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new MergeRequestQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(MergeRequestConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTotalTimeToMerge()
    {
        $this->selectField("totalTimeToMerge");

        return $this;
    }
}
