<?php

namespace GraphQL\SchemaObject;

class CoverageFuzzingCorpusQueryObject extends QueryObject
{
    const OBJECT_NAME = "CoverageFuzzingCorpus";

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectPackage(CoverageFuzzingCorpusPackageArgumentsObject $argsObject = null)
    {
        $object = new PackageDetailsTypeQueryObject("package");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
