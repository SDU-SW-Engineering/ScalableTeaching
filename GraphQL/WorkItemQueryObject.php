<?php

namespace GraphQL\SchemaObject;

class WorkItemQueryObject extends QueryObject
{
    const OBJECT_NAME = "WorkItem";

    /**
     * @deprecated **Status**: Experiment. Introduced in 16.5.
     */
    public function selectArchived()
    {
        $this->selectField("archived");

        return $this;
    }

    /**
     * @deprecated **Status**: Experiment. Introduced in 15.9.
     */
    public function selectAuthor(WorkItemAuthorArgumentsObject $argsObject = null)
    {
        $object = new UserCoreQueryObject("author");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectClosedAt()
    {
        $this->selectField("closedAt");

        return $this;
    }

    public function selectConfidential()
    {
        $this->selectField("confidential");

        return $this;
    }

    public function selectCreateNoteEmail()
    {
        $this->selectField("createNoteEmail");

        return $this;
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

    public function selectLockVersion()
    {
        $this->selectField("lockVersion");

        return $this;
    }

    /**
     * @deprecated **Status**: Experiment. Introduced in 15.10.
     */
    public function selectNamespace(WorkItemNamespaceArgumentsObject $argsObject = null)
    {
        $object = new NamespaceQueryObject("namespace");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    /**
     * @deprecated **Status**: Experiment. Introduced in 15.3.
     */
    public function selectProject(WorkItemProjectArgumentsObject $argsObject = null)
    {
        $object = new ProjectQueryObject("project");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectReference()
    {
        $this->selectField("reference");

        return $this;
    }

    public function selectState()
    {
        $this->selectField("state");

        return $this;
    }

    public function selectTitle()
    {
        $this->selectField("title");

        return $this;
    }

    public function selectTitleHtml()
    {
        $this->selectField("titleHtml");

        return $this;
    }

    public function selectUpdatedAt()
    {
        $this->selectField("updatedAt");

        return $this;
    }

    public function selectUserPermissions(WorkItemUserPermissionsArgumentsObject $argsObject = null)
    {
        $object = new WorkItemPermissionsQueryObject("userPermissions");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectWebUrl()
    {
        $this->selectField("webUrl");

        return $this;
    }

    public function selectWorkItemType(WorkItemWorkItemTypeArgumentsObject $argsObject = null)
    {
        $object = new WorkItemTypeQueryObject("workItemType");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
