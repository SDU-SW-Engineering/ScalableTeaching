<?php

namespace GraphQL\SchemaObject;

class EnvironmentQueryObject extends QueryObject
{
    const OBJECT_NAME = "Environment";

    public function selectAutoDeleteAt()
    {
        $this->selectField("autoDeleteAt");

        return $this;
    }

    public function selectAutoStopAt()
    {
        $this->selectField("autoStopAt");

        return $this;
    }

    public function selectClusterAgent(EnvironmentClusterAgentArgumentsObject $argsObject = null)
    {
        $object = new ClusterAgentQueryObject("clusterAgent");
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

    public function selectDeployFreezes(EnvironmentDeployFreezesArgumentsObject $argsObject = null)
    {
        $object = new CiFreezePeriodQueryObject("deployFreezes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectDeployments(EnvironmentDeploymentsArgumentsObject $argsObject = null)
    {
        $object = new DeploymentConnectionQueryObject("deployments");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectEnvironmentType()
    {
        $this->selectField("environmentType");

        return $this;
    }

    public function selectExternalUrl()
    {
        $this->selectField("externalUrl");

        return $this;
    }

    public function selectFluxResourcePath()
    {
        $this->selectField("fluxResourcePath");

        return $this;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectKubernetesNamespace()
    {
        $this->selectField("kubernetesNamespace");

        return $this;
    }

    public function selectLastDeployment(EnvironmentLastDeploymentArgumentsObject $argsObject = null)
    {
        $object = new DeploymentQueryObject("lastDeployment");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectLatestOpenedMostSevereAlert(EnvironmentLatestOpenedMostSevereAlertArgumentsObject $argsObject = null)
    {
        $object = new AlertManagementAlertQueryObject("latestOpenedMostSevereAlert");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectName()
    {
        $this->selectField("name");

        return $this;
    }

    public function selectPath()
    {
        $this->selectField("path");

        return $this;
    }

    public function selectSlug()
    {
        $this->selectField("slug");

        return $this;
    }

    public function selectState()
    {
        $this->selectField("state");

        return $this;
    }

    public function selectTier()
    {
        $this->selectField("tier");

        return $this;
    }

    public function selectUpdatedAt()
    {
        $this->selectField("updatedAt");

        return $this;
    }

    public function selectUserPermissions(EnvironmentUserPermissionsArgumentsObject $argsObject = null)
    {
        $object = new EnvironmentPermissionsQueryObject("userPermissions");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
