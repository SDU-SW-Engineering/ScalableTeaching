<?php

namespace GraphQL\SchemaObject;

class MlCandidateConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "MlCandidateConnection";

    public function selectCount()
    {
        $this->selectField("count");

        return $this;
    }

    public function selectEdges(MlCandidateConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new MlCandidateEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(MlCandidateConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new MlCandidateQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(MlCandidateConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
