<?php

namespace GraphQL\SchemaObject;

class NegatedEpicFilterInputInputObject extends InputObject
{
    protected $labelName;
    protected $authorUsername;
    protected $myReactionEmoji;

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
}
