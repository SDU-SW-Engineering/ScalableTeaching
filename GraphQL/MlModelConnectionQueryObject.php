<?php

namespace GraphQL\SchemaObject;

class MlModelConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "MlModelConnection";

    public function selectCount()
    {
        $this->selectField("count");

        return $this;
    }

    public function selectEdges(MlModelConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new MlModelEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(MlModelConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new MlModelQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(MlModelConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
