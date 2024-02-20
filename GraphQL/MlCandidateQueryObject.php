<?php

namespace GraphQL\SchemaObject;

class MlCandidateQueryObject extends QueryObject
{
    const OBJECT_NAME = "MlCandidate";

    public function selectLinks(MlCandidateLinksArgumentsObject $argsObject = null)
    {
        $object = new MLCandidateLinksQueryObject("_links");
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

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectName()
    {
        $this->selectField("name");

        return $this;
    }
}
