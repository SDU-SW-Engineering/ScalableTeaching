<?php

namespace GraphQL\SchemaObject;

class CiCatalogResourceVersionQueryObject extends QueryObject
{
    const OBJECT_NAME = "CiCatalogResourceVersion";

    /**
     * @deprecated **Status**: Experiment. Introduced in 16.7.
     */
    public function selectAuthor(CiCatalogResourceVersionAuthorArgumentsObject $argsObject = null)
    {
        $object = new UserCoreQueryObject("author");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    /**
     * @deprecated **Status**: Experiment. Introduced in 16.7.
     */
    public function selectCommit(CiCatalogResourceVersionCommitArgumentsObject $argsObject = null)
    {
        $object = new CommitQueryObject("commit");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    /**
     * @deprecated **Status**: Experiment. Introduced in 16.7.
     */
    public function selectComponents(CiCatalogResourceVersionComponentsArgumentsObject $argsObject = null)
    {
        $object = new CiCatalogResourceComponentConnectionQueryObject("components");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    /**
     * @deprecated **Status**: Experiment. Introduced in 16.7.
     */
    public function selectCreatedAt()
    {
        $this->selectField("createdAt");

        return $this;
    }

    /**
     * @deprecated **Status**: Experiment. Introduced in 16.7.
     */
    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    /**
     * @deprecated **Status**: Experiment. Introduced in 16.8.
     */
    public function selectName()
    {
        $this->selectField("name");

        return $this;
    }

    /**
     * @deprecated **Status**: Experiment. Introduced in 16.8.
     */
    public function selectPath()
    {
        $this->selectField("path");

        return $this;
    }

    /**
     * @deprecated **Status**: Experiment. Introduced in 16.8.
     */
    public function selectReadmeHtml()
    {
        $this->selectField("readmeHtml");

        return $this;
    }

    /**
     * @deprecated **Status**: Experiment. Introduced in 16.7.
     */
    public function selectReleasedAt()
    {
        $this->selectField("releasedAt");

        return $this;
    }
}
