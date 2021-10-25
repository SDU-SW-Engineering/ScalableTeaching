<?php

namespace GraphQL\SchemaObject;

class MergeRequestReviewerConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "MergeRequestReviewerConnection";

    public function selectEdges(MergeRequestReviewerConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new MergeRequestReviewerEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(MergeRequestReviewerConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new MergeRequestReviewerQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(MergeRequestReviewerConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
