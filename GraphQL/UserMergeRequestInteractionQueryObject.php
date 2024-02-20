<?php

namespace GraphQL\SchemaObject;

class UserMergeRequestInteractionQueryObject extends QueryObject
{
    const OBJECT_NAME = "UserMergeRequestInteraction";

    public function selectApproved()
    {
        $this->selectField("approved");

        return $this;
    }

    public function selectCanMerge()
    {
        $this->selectField("canMerge");

        return $this;
    }

    public function selectCanUpdate()
    {
        $this->selectField("canUpdate");

        return $this;
    }

    public function selectReviewState()
    {
        $this->selectField("reviewState");

        return $this;
    }

    public function selectReviewed()
    {
        $this->selectField("reviewed");

        return $this;
    }
}
