<?php

namespace GraphQL\SchemaObject;

class GroupWikiRepositoryRegistryEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "GroupWikiRepositoryRegistryEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(GroupWikiRepositoryRegistryEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new GroupWikiRepositoryRegistryQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
