<?php

namespace GraphQL\SchemaObject;

class SentryErrorQueryObject extends QueryObject
{
    const OBJECT_NAME = "SentryError";

    public function selectCount()
    {
        $this->selectField("count");

        return $this;
    }

    public function selectCulprit()
    {
        $this->selectField("culprit");

        return $this;
    }

    public function selectExternalUrl()
    {
        $this->selectField("externalUrl");

        return $this;
    }

    public function selectFirstSeen()
    {
        $this->selectField("firstSeen");

        return $this;
    }

    public function selectFrequency(SentryErrorFrequencyArgumentsObject $argsObject = null)
    {
        $object = new SentryErrorFrequencyQueryObject("frequency");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectLastSeen()
    {
        $this->selectField("lastSeen");

        return $this;
    }

    public function selectMessage()
    {
        $this->selectField("message");

        return $this;
    }

    public function selectSentryId()
    {
        $this->selectField("sentryId");

        return $this;
    }

    public function selectSentryProjectId()
    {
        $this->selectField("sentryProjectId");

        return $this;
    }

    public function selectSentryProjectName()
    {
        $this->selectField("sentryProjectName");

        return $this;
    }

    public function selectSentryProjectSlug()
    {
        $this->selectField("sentryProjectSlug");

        return $this;
    }

    public function selectShortId()
    {
        $this->selectField("shortId");

        return $this;
    }

    public function selectStatus()
    {
        $this->selectField("status");

        return $this;
    }

    public function selectTitle()
    {
        $this->selectField("title");

        return $this;
    }

    public function selectType()
    {
        $this->selectField("type");

        return $this;
    }

    public function selectUserCount()
    {
        $this->selectField("userCount");

        return $this;
    }
}
