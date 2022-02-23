<?php

namespace GraphQL\SchemaObject;

class IssuePermissionsQueryObject extends QueryObject
{
    const OBJECT_NAME = "IssuePermissions";

    public function selectAdminIssue()
    {
        $this->selectField("adminIssue");

        return $this;
    }

    public function selectCreateDesign()
    {
        $this->selectField("createDesign");

        return $this;
    }

    public function selectCreateNote()
    {
        $this->selectField("createNote");

        return $this;
    }

    public function selectDestroyDesign()
    {
        $this->selectField("destroyDesign");

        return $this;
    }

    public function selectReadDesign()
    {
        $this->selectField("readDesign");

        return $this;
    }

    public function selectReadIssue()
    {
        $this->selectField("readIssue");

        return $this;
    }

    public function selectReopenIssue()
    {
        $this->selectField("reopenIssue");

        return $this;
    }

    public function selectUpdateIssue()
    {
        $this->selectField("updateIssue");

        return $this;
    }
}
