<?php

namespace GraphQL\SchemaObject;

class MemberInterfaceConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "MemberInterfaceConnection";

    public function selectEdges(MemberInterfaceConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new MemberInterfaceEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(MemberInterfaceConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
