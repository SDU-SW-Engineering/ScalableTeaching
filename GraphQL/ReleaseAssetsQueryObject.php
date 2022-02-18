<?php

namespace GraphQL\SchemaObject;

class ReleaseAssetsQueryObject extends QueryObject
{
    const OBJECT_NAME = "ReleaseAssets";

    public function selectCount()
    {
        $this->selectField("count");

        return $this;
    }

    public function selectLinks(ReleaseAssetsLinksArgumentsObject $argsObject = null)
    {
        $object = new ReleaseAssetLinkConnectionQueryObject("links");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSources(ReleaseAssetsSourcesArgumentsObject $argsObject = null)
    {
        $object = new ReleaseSourceConnectionQueryObject("sources");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
