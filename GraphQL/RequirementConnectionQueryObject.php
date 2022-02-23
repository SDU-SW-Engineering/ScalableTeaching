<?php

namespace GraphQL\SchemaObject;

class RequirementConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "RequirementConnection";

    public function selectEdges(RequirementConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new RequirementEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(RequirementConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new RequirementQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(RequirementConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
