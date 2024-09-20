<?php

namespace GraphQL\SchemaObject;

class MergeRequestParticipantConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "MergeRequestParticipantConnection";

    public function selectCount()
    {
        $this->selectField("count");

        return $this;
    }

    public function selectEdges(MergeRequestParticipantConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new MergeRequestParticipantEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(MergeRequestParticipantConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new MergeRequestParticipantQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(MergeRequestParticipantConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
