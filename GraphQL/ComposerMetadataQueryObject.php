<?php

namespace GraphQL\SchemaObject;

class ComposerMetadataQueryObject extends QueryObject
{
    const OBJECT_NAME = "ComposerMetadata";

    public function selectComposerJson(ComposerMetadataComposerJsonArgumentsObject $argsObject = null)
    {
        $object = new PackageComposerJsonTypeQueryObject("composerJson");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTargetSha()
    {
        $this->selectField("targetSha");

        return $this;
    }
}
