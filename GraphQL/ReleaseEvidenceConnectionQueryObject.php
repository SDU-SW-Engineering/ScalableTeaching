<?php

namespace GraphQL\SchemaObject;

class ReleaseEvidenceConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "ReleaseEvidenceConnection";

    public function selectEdges(ReleaseEvidenceConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new ReleaseEvidenceEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(ReleaseEvidenceConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new ReleaseEvidenceQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(ReleaseEvidenceConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
