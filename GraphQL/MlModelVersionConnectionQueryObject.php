<?php

namespace GraphQL\SchemaObject;

class MlModelVersionConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "MlModelVersionConnection";

    public function selectCount()
    {
        $this->selectField("count");

        return $this;
    }

    public function selectEdges(MlModelVersionConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new MlModelVersionEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(MlModelVersionConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new MlModelVersionQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(MlModelVersionConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
