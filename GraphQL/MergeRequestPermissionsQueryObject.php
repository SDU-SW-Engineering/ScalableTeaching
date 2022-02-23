<?php

namespace GraphQL\SchemaObject;

class MergeRequestPermissionsQueryObject extends QueryObject
{
    const OBJECT_NAME = "MergeRequestPermissions";

    public function selectAdminMergeRequest()
    {
        $this->selectField("adminMergeRequest");

        return $this;
    }

    public function selectCanMerge()
    {
        $this->selectField("canMerge");

        return $this;
    }

    public function selectCherryPickOnCurrentMergeRequest()
    {
        $this->selectField("cherryPickOnCurrentMergeRequest");

        return $this;
    }

    public function selectCreateNote()
    {
        $this->selectField("createNote");

        return $this;
    }

    public function selectPushToSourceBranch()
    {
        $this->selectField("pushToSourceBranch");

        return $this;
    }

    public function selectReadMergeRequest()
    {
        $this->selectField("readMergeRequest");

        return $this;
    }

    public function selectRemoveSourceBranch()
    {
        $this->selectField("removeSourceBranch");

        return $this;
    }

    public function selectRevertOnCurrentMergeRequest()
    {
        $this->selectField("revertOnCurrentMergeRequest");

        return $this;
    }

    public function selectUpdateMergeRequest()
    {
        $this->selectField("updateMergeRequest");

        return $this;
    }
}
