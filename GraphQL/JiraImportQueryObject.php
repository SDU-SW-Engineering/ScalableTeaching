<?php

namespace GraphQL\SchemaObject;

class JiraImportQueryObject extends QueryObject
{
    const OBJECT_NAME = "JiraImport";

    public function selectCreatedAt()
    {
        $this->selectField("createdAt");

        return $this;
    }

    public function selectFailedToImportCount()
    {
        $this->selectField("failedToImportCount");

        return $this;
    }

    public function selectImportedIssuesCount()
    {
        $this->selectField("importedIssuesCount");

        return $this;
    }

    public function selectJiraProjectKey()
    {
        $this->selectField("jiraProjectKey");

        return $this;
    }

    public function selectScheduledAt()
    {
        $this->selectField("scheduledAt");

        return $this;
    }

    public function selectScheduledBy(JiraImportScheduledByArgumentsObject $argsObject = null)
    {
        $object = new UserCoreQueryObject("scheduledBy");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTotalIssueCount()
    {
        $this->selectField("totalIssueCount");

        return $this;
    }
}
