<?php

namespace GraphQL\SchemaObject;

class ReleaseConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "ReleaseConnection";

    public function selectCount()
    {
        $this->selectField("count");

        return $this;
    }

    public function selectEdges(ReleaseConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new ReleaseEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(ReleaseConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new ReleaseQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(ReleaseConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
