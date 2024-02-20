<?php

namespace GraphQL\SchemaObject;

class ProjectPermissionsQueryObject extends QueryObject
{
    const OBJECT_NAME = "ProjectPermissions";

    public function selectAdminOperations()
    {
        $this->selectField("adminOperations");

        return $this;
    }

    public function selectAdminProject()
    {
        $this->selectField("adminProject");

        return $this;
    }

    public function selectAdminRemoteMirror()
    {
        $this->selectField("adminRemoteMirror");

        return $this;
    }

    public function selectAdminWiki()
    {
        $this->selectField("adminWiki");

        return $this;
    }

    public function selectArchiveProject()
    {
        $this->selectField("archiveProject");

        return $this;
    }

    public function selectChangeNamespace()
    {
        $this->selectField("changeNamespace");

        return $this;
    }

    public function selectChangeVisibilityLevel()
    {
        $this->selectField("changeVisibilityLevel");

        return $this;
    }

    public function selectCreateDeployment()
    {
        $this->selectField("createDeployment");

        return $this;
    }

    public function selectCreateDesign()
    {
        $this->selectField("createDesign");

        return $this;
    }

    public function selectCreateIssue()
    {
        $this->selectField("createIssue");

        return $this;
    }

    public function selectCreateLabel()
    {
        $this->selectField("createLabel");

        return $this;
    }

    public function selectCreateMergeRequestFrom()
    {
        $this->selectField("createMergeRequestFrom");

        return $this;
    }

    public function selectCreateMergeRequestIn()
    {
        $this->selectField("createMergeRequestIn");

        return $this;
    }

    public function selectCreatePages()
    {
        $this->selectField("createPages");

        return $this;
    }

    public function selectCreatePipeline()
    {
        $this->selectField("createPipeline");

        return $this;
    }

    public function selectCreatePipelineSchedule()
    {
        $this->selectField("createPipelineSchedule");

        return $this;
    }

    public function selectCreateSnippet()
    {
        $this->selectField("createSnippet");

        return $this;
    }

    public function selectCreateWiki()
    {
        $this->selectField("createWiki");

        return $this;
    }

    public function selectDestroyDesign()
    {
        $this->selectField("destroyDesign");

        return $this;
    }

    public function selectDestroyPages()
    {
        $this->selectField("destroyPages");

        return $this;
    }

    public function selectDestroyWiki()
    {
        $this->selectField("destroyWiki");

        return $this;
    }

    public function selectDownloadCode()
    {
        $this->selectField("downloadCode");

        return $this;
    }

    public function selectDownloadWikiCode()
    {
        $this->selectField("downloadWikiCode");

        return $this;
    }

    public function selectForkProject()
    {
        $this->selectField("forkProject");

        return $this;
    }

    public function selectPushCode()
    {
        $this->selectField("pushCode");

        return $this;
    }

    public function selectPushToDeleteProtectedBranch()
    {
        $this->selectField("pushToDeleteProtectedBranch");

        return $this;
    }

    public function selectReadCommitStatus()
    {
        $this->selectField("readCommitStatus");

        return $this;
    }

    public function selectReadCycleAnalytics()
    {
        $this->selectField("readCycleAnalytics");

        return $this;
    }

    public function selectReadDesign()
    {
        $this->selectField("readDesign");

        return $this;
    }

    public function selectReadEnvironment()
    {
        $this->selectField("readEnvironment");

        return $this;
    }

    public function selectReadMergeRequest()
    {
        $this->selectField("readMergeRequest");

        return $this;
    }

    public function selectReadPagesContent()
    {
        $this->selectField("readPagesContent");

        return $this;
    }

    public function selectReadProject()
    {
        $this->selectField("readProject");

        return $this;
    }

    public function selectReadProjectMember()
    {
        $this->selectField("readProjectMember");

        return $this;
    }

    public function selectReadWiki()
    {
        $this->selectField("readWiki");

        return $this;
    }

    public function selectRemoveForkProject()
    {
        $this->selectField("removeForkProject");

        return $this;
    }

    public function selectRemovePages()
    {
        $this->selectField("removePages");

        return $this;
    }

    public function selectRemoveProject()
    {
        $this->selectField("removeProject");

        return $this;
    }

    public function selectRenameProject()
    {
        $this->selectField("renameProject");

        return $this;
    }

    public function selectRequestAccess()
    {
        $this->selectField("requestAccess");

        return $this;
    }

    public function selectUpdatePages()
    {
        $this->selectField("updatePages");

        return $this;
    }

    public function selectUpdateWiki()
    {
        $this->selectField("updateWiki");

        return $this;
    }

    public function selectUploadFile()
    {
        $this->selectField("uploadFile");

        return $this;
    }
}
