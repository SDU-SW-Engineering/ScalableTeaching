<?php

namespace GraphQL\SchemaObject;

class ReleaseQueryObject extends QueryObject
{
    const OBJECT_NAME = "Release";

    public function selectAssets(ReleaseAssetsArgumentsObject $argsObject = null)
    {
        $object = new ReleaseAssetsQueryObject("assets");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectAuthor(ReleaseAuthorArgumentsObject $argsObject = null)
    {
        $object = new UserCoreQueryObject("author");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCommit(ReleaseCommitArgumentsObject $argsObject = null)
    {
        $object = new CommitQueryObject("commit");
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

    public function selectDescriptionHtml()
    {
        $this->selectField("descriptionHtml");

        return $this;
    }

    public function selectEvidences(ReleaseEvidencesArgumentsObject $argsObject = null)
    {
        $object = new ReleaseEvidenceConnectionQueryObject("evidences");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectHistoricalRelease()
    {
        $this->selectField("historicalRelease");

        return $this;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectLinks(ReleaseLinksArgumentsObject $argsObject = null)
    {
        $object = new ReleaseLinksQueryObject("links");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectMilestones(ReleaseMilestonesArgumentsObject $argsObject = null)
    {
        $object = new MilestoneConnectionQueryObject("milestones");
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

    public function selectReleasedAt()
    {
        $this->selectField("releasedAt");

        return $this;
    }

    public function selectTagName()
    {
        $this->selectField("tagName");

        return $this;
    }

    public function selectTagPath()
    {
        $this->selectField("tagPath");

        return $this;
    }

    public function selectUpcomingRelease()
    {
        $this->selectField("upcomingRelease");

        return $this;
    }
}
