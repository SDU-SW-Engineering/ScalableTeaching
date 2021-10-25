<?php

namespace GraphQL\SchemaObject;

class NoteConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "NoteConnection";

    public function selectEdges(NoteConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new NoteEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(NoteConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new NoteQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(NoteConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
