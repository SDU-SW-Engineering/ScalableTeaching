<?php

namespace GraphQL\SchemaObject;

class CoverageFuzzingCorpusConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "CoverageFuzzingCorpusConnection";

    public function selectEdges(CoverageFuzzingCorpusConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new CoverageFuzzingCorpusEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(CoverageFuzzingCorpusConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new CoverageFuzzingCorpusQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(CoverageFuzzingCorpusConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
