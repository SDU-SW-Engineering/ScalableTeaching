<?php

namespace GraphQL\SchemaObject;

class DastProfileConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "DastProfileConnection";

    public function selectEdges(DastProfileConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new DastProfileEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(DastProfileConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new DastProfileQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(DastProfileConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
