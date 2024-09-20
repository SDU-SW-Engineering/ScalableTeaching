<?php

namespace GraphQL\SchemaObject;

class CommitDataQueryObject extends QueryObject
{
    const OBJECT_NAME = "CommitData";

    public function selectAgeMapClass()
    {
        $this->selectField("ageMapClass");

        return $this;
    }

    public function selectAuthorAvatar()
    {
        $this->selectField("authorAvatar");

        return $this;
    }

    public function selectCommitAuthorLink()
    {
        $this->selectField("commitAuthorLink");

        return $this;
    }

    public function selectCommitLink()
    {
        $this->selectField("commitLink");

        return $this;
    }

    public function selectProjectBlameLink()
    {
        $this->selectField("projectBlameLink");

        return $this;
    }

    public function selectTimeAgoTooltip()
    {
        $this->selectField("timeAgoTooltip");

        return $this;
    }
}
