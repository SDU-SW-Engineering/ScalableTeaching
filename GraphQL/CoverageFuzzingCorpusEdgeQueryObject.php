<?php

namespace GraphQL\SchemaObject;

class CoverageFuzzingCorpusEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "CoverageFuzzingCorpusEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(CoverageFuzzingCorpusEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new CoverageFuzzingCorpusQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
