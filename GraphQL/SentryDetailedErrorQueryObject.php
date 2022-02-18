<?php

namespace GraphQL\SchemaObject;

class SentryDetailedErrorQueryObject extends QueryObject
{
    const OBJECT_NAME = "SentryDetailedError";

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

    public function selectExternalBaseUrl()
    {
        $this->selectField("externalBaseUrl");

        return $this;
    }

    public function selectExternalUrl()
    {
        $this->selectField("externalUrl");

        return $this;
    }

    public function selectFirstReleaseLastCommit()
    {
        $this->selectField("firstReleaseLastCommit");

        return $this;
    }

    public function selectFirstReleaseShortVersion()
    {
        $this->selectField("firstReleaseShortVersion");

        return $this;
    }

    public function selectFirstReleaseVersion()
    {
        $this->selectField("firstReleaseVersion");

        return $this;
    }

    public function selectFirstSeen()
    {
        $this->selectField("firstSeen");

        return $this;
    }

    public function selectFrequency(SentryDetailedErrorFrequencyArgumentsObject $argsObject = null)
    {
        $object = new SentryErrorFrequencyQueryObject("frequency");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectGitlabCommit()
    {
        $this->selectField("gitlabCommit");

        return $this;
    }

    public function selectGitlabCommitPath()
    {
        $this->selectField("gitlabCommitPath");

        return $this;
    }

    public function selectGitlabIssuePath()
    {
        $this->selectField("gitlabIssuePath");

        return $this;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectIntegrated()
    {
        $this->selectField("integrated");

        return $this;
    }

    public function selectLastReleaseLastCommit()
    {
        $this->selectField("lastReleaseLastCommit");

        return $this;
    }

    public function selectLastReleaseShortVersion()
    {
        $this->selectField("lastReleaseShortVersion");

        return $this;
    }

    public function selectLastReleaseVersion()
    {
        $this->selectField("lastReleaseVersion");

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

    public function selectTags(SentryDetailedErrorTagsArgumentsObject $argsObject = null)
    {
        $object = new SentryErrorTagsQueryObject("tags");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
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
