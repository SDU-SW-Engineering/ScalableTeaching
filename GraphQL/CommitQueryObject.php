<?php

namespace GraphQL\SchemaObject;

class CommitQueryObject extends QueryObject
{
    const OBJECT_NAME = "Commit";

    public function selectAuthor(CommitAuthorArgumentsObject $argsObject = null)
    {
        $object = new UserCoreQueryObject("author");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectAuthorEmail()
    {
        $this->selectField("authorEmail");

        return $this;
    }

    public function selectAuthorGravatar()
    {
        $this->selectField("authorGravatar");

        return $this;
    }

    public function selectAuthorName()
    {
        $this->selectField("authorName");

        return $this;
    }

    public function selectAuthoredDate()
    {
        $this->selectField("authoredDate");

        return $this;
    }

    public function selectDescription()
    {
        $this->selectField("description");

        return $this;
    }

    public function selectDescriptionHtml()
    {
        $this->selectField("descriptionHtml");

        return $this;
    }

    public function selectFullTitle()
    {
        $this->selectField("fullTitle");

        return $this;
    }

    public function selectFullTitleHtml()
    {
        $this->selectField("fullTitleHtml");

        return $this;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectMessage()
    {
        $this->selectField("message");

        return $this;
    }

    public function selectPipelines(CommitPipelinesArgumentsObject $argsObject = null)
    {
        $object = new PipelineConnectionQueryObject("pipelines");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSha()
    {
        $this->selectField("sha");

        return $this;
    }

    public function selectShortId()
    {
        $this->selectField("shortId");

        return $this;
    }

    public function selectSignatureHtml()
    {
        $this->selectField("signatureHtml");

        return $this;
    }

    public function selectTitle()
    {
        $this->selectField("title");

        return $this;
    }

    public function selectTitleHtml()
    {
        $this->selectField("titleHtml");

        return $this;
    }

    public function selectWebPath()
    {
        $this->selectField("webPath");

        return $this;
    }

    public function selectWebUrl()
    {
        $this->selectField("webUrl");

        return $this;
    }
}
