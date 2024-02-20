<?php

namespace GraphQL\SchemaObject;

class DeploymentQueryObject extends QueryObject
{
    const OBJECT_NAME = "Deployment";

    public function selectCommit(DeploymentCommitArgumentsObject $argsObject = null)
    {
        $object = new CommitQueryObject("commit");
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

    public function selectFinishedAt()
    {
        $this->selectField("finishedAt");

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

    public function selectJob(DeploymentJobArgumentsObject $argsObject = null)
    {
        $object = new CiJobQueryObject("job");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectRef()
    {
        $this->selectField("ref");

        return $this;
    }

    public function selectRefPath()
    {
        $this->selectField("refPath");

        return $this;
    }

    public function selectSha()
    {
        $this->selectField("sha");

        return $this;
    }

    public function selectStatus()
    {
        $this->selectField("status");

        return $this;
    }

    public function selectTag()
    {
        $this->selectField("tag");

        return $this;
    }

    public function selectTags(DeploymentTagsArgumentsObject $argsObject = null)
    {
        $object = new DeploymentTagQueryObject("tags");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTriggerer(DeploymentTriggererArgumentsObject $argsObject = null)
    {
        $object = new UserCoreQueryObject("triggerer");
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

    public function selectUserPermissions(DeploymentUserPermissionsArgumentsObject $argsObject = null)
    {
        $object = new DeploymentPermissionsQueryObject("userPermissions");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
