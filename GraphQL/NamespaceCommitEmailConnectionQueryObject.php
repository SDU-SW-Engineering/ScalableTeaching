<?php

namespace GraphQL\SchemaObject;

class NamespaceCommitEmailConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "NamespaceCommitEmailConnection";

    public function selectEdges(NamespaceCommitEmailConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new NamespaceCommitEmailEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(NamespaceCommitEmailConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new NamespaceCommitEmailQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(NamespaceCommitEmailConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
