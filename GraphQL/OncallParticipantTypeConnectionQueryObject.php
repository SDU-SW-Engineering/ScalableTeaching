<?php

namespace GraphQL\SchemaObject;

class OncallParticipantTypeConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "OncallParticipantTypeConnection";

    public function selectEdges(OncallParticipantTypeConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new OncallParticipantTypeEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(OncallParticipantTypeConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new OncallParticipantTypeQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(OncallParticipantTypeConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
