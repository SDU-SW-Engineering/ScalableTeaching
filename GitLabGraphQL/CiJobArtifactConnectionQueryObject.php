<?php

namespace GraphQL\SchemaObject;

class CiJobArtifactConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "CiJobArtifactConnection";

    public function selectEdges(CiJobArtifactConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new CiJobArtifactEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(CiJobArtifactConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new CiJobArtifactQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(CiJobArtifactConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
