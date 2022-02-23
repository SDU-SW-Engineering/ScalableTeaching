<?php

namespace GraphQL\SchemaObject;

class EpicFiltersInputObject extends InputObject
{
    protected $labelName;
    protected $authorUsername;
    protected $myReactionEmoji;
    protected $not;
    protected $search;
    protected $confidential;

    public function setLabelName(array $labelName)
    {
        $this->labelName = $labelName;

        return $this;
    }

    public function setAuthorUsername($authorUsername)
    {
        $this->authorUsername = $authorUsername;

        return $this;
    }

    public function setMyReactionEmoji($myReactionEmoji)
    {
        $this->myReactionEmoji = $myReactionEmoji;

        return $this;
    }

    public function setNot(NegatedEpicBoardIssueInputInputObject $negatedEpicBoardIssueInputInputObject)
    {
        $this->not = $negatedEpicBoardIssueInputInputObject;

        return $this;
    }

    public function setSearch($search)
    {
        $this->search = $search;

        return $this;
    }

    public function setConfidential($confidential)
    {
        $this->confidential = $confidential;

        return $this;
    }
}
