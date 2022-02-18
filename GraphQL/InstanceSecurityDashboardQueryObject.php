<?php

namespace GraphQL\SchemaObject;

class InstanceSecurityDashboardQueryObject extends QueryObject
{
    const OBJECT_NAME = "InstanceSecurityDashboard";

    public function selectProjects(InstanceSecurityDashboardProjectsArgumentsObject $argsObject = null)
    {
        $object = new ProjectConnectionQueryObject("projects");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectVulnerabilityGrades(InstanceSecurityDashboardVulnerabilityGradesArgumentsObject $argsObject = null)
    {
        $object = new VulnerableProjectsByGradeQueryObject("vulnerabilityGrades");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectVulnerabilityScanners(InstanceSecurityDashboardVulnerabilityScannersArgumentsObject $argsObject = null)
    {
        $object = new VulnerabilityScannerConnectionQueryObject("vulnerabilityScanners");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectVulnerabilitySeveritiesCount(InstanceSecurityDashboardVulnerabilitySeveritiesCountArgumentsObject $argsObject = null)
    {
        $object = new VulnerabilitySeveritiesCountQueryObject("vulnerabilitySeveritiesCount");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
