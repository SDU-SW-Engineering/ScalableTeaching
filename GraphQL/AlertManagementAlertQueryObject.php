<?php

namespace GraphQL\SchemaObject;

class AlertManagementAlertQueryObject extends QueryObject
{
    const OBJECT_NAME = "AlertManagementAlert";

    public function selectAssignees(AlertManagementAlertAssigneesArgumentsObject $argsObject = null)
    {
        $object = new UserCoreConnectionQueryObject("assignees");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCommenters(AlertManagementAlertCommentersArgumentsObject $argsObject = null)
    {
        $object = new UserCoreConnectionQueryObject("commenters");
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

    public function selectDetails()
    {
        $this->selectField("details");

        return $this;
    }

    public function selectDetailsUrl()
    {
        $this->selectField("detailsUrl");

        return $this;
    }

    public function selectDiscussions(AlertManagementAlertDiscussionsArgumentsObject $argsObject = null)
    {
        $object = new DiscussionConnectionQueryObject("discussions");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectEndedAt()
    {
        $this->selectField("endedAt");

        return $this;
    }

    public function selectEnvironment(AlertManagementAlertEnvironmentArgumentsObject $argsObject = null)
    {
        $object = new EnvironmentQueryObject("environment");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectEventCount()
    {
        $this->selectField("eventCount");

        return $this;
    }

    public function selectHosts()
    {
        $this->selectField("hosts");

        return $this;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectIid()
    {
        $this->selectField("iid");

        return $this;
    }

    public function selectIssue(AlertManagementAlertIssueArgumentsObject $argsObject = null)
    {
        $object = new IssueQueryObject("issue");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    /**
     * @deprecated Use issue field. Deprecated in 13.10.
     */
    public function selectIssueIid()
    {
        $this->selectField("issueIid");

        return $this;
    }

    /**
     * @deprecated Returns no data. Underlying feature was removed in 16.0. Deprecated in 16.0.
     */
    public function selectMetricsDashboardUrl()
    {
        $this->selectField("metricsDashboardUrl");

        return $this;
    }

    public function selectMonitoringTool()
    {
        $this->selectField("monitoringTool");

        return $this;
    }

    public function selectNotes(AlertManagementAlertNotesArgumentsObject $argsObject = null)
    {
        $object = new NoteConnectionQueryObject("notes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPrometheusAlert(AlertManagementAlertPrometheusAlertArgumentsObject $argsObject = null)
    {
        $object = new PrometheusAlertQueryObject("prometheusAlert");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectRunbook()
    {
        $this->selectField("runbook");

        return $this;
    }

    public function selectService()
    {
        $this->selectField("service");

        return $this;
    }

    public function selectSeverity()
    {
        $this->selectField("severity");

        return $this;
    }

    public function selectStartedAt()
    {
        $this->selectField("startedAt");

        return $this;
    }

    public function selectStatus()
    {
        $this->selectField("status");

        return $this;
    }

    public function selectTitle()
    {
        $this->selectField("title");

        return $this;
    }

    public function selectTodos(AlertManagementAlertTodosArgumentsObject $argsObject = null)
    {
        $object = new TodoConnectionQueryObject("todos");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectUpdatedAt()
    {
        $this->selectField("updatedAt");

        return $this;
    }

    public function selectWebUrl()
    {
        $this->selectField("webUrl");

        return $this;
    }
}
