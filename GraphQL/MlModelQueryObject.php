<?php

namespace GraphQL\SchemaObject;

class MlModelQueryObject extends QueryObject
{
    const OBJECT_NAME = "MlModel";

    public function selectLinks(MlModelLinksArgumentsObject $argsObject = null)
    {
        $object = new MLModelLinksQueryObject("_links");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCandidates(MlModelCandidatesArgumentsObject $argsObject = null)
    {
        $object = new MlCandidateConnectionQueryObject("candidates");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCreatedAt()
    {
        $this->selectField("createdAt");

        return $this;
    }

    public function selectDescription()
    {
        $this->selectField("description");

        return $this;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectLatestVersion(MlModelLatestVersionArgumentsObject $argsObject = null)
    {
        $object = new MlModelVersionQueryObject("latestVersion");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectName()
    {
        $this->selectField("name");

        return $this;
    }

    public function selectVersionCount()
    {
        $this->selectField("versionCount");

        return $this;
    }

    public function selectVersions(MlModelVersionsArgumentsObject $argsObject = null)
    {
        $object = new MlModelVersionConnectionQueryObject("versions");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
