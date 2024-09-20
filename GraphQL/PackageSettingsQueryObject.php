<?php

namespace GraphQL\SchemaObject;

class PackageSettingsQueryObject extends QueryObject
{
    const OBJECT_NAME = "PackageSettings";

    public function selectGenericDuplicateExceptionRegex()
    {
        $this->selectField("genericDuplicateExceptionRegex");

        return $this;
    }

    public function selectGenericDuplicatesAllowed()
    {
        $this->selectField("genericDuplicatesAllowed");

        return $this;
    }

    public function selectLockMavenPackageRequestsForwarding()
    {
        $this->selectField("lockMavenPackageRequestsForwarding");

        return $this;
    }

    public function selectLockNpmPackageRequestsForwarding()
    {
        $this->selectField("lockNpmPackageRequestsForwarding");

        return $this;
    }

    public function selectLockPypiPackageRequestsForwarding()
    {
        $this->selectField("lockPypiPackageRequestsForwarding");

        return $this;
    }

    public function selectMavenDuplicateExceptionRegex()
    {
        $this->selectField("mavenDuplicateExceptionRegex");

        return $this;
    }

    public function selectMavenDuplicatesAllowed()
    {
        $this->selectField("mavenDuplicatesAllowed");

        return $this;
    }

    public function selectMavenPackageRequestsForwarding()
    {
        $this->selectField("mavenPackageRequestsForwarding");

        return $this;
    }

    public function selectMavenPackageRequestsForwardingLocked()
    {
        $this->selectField("mavenPackageRequestsForwardingLocked");

        return $this;
    }

    public function selectNpmPackageRequestsForwarding()
    {
        $this->selectField("npmPackageRequestsForwarding");

        return $this;
    }

    public function selectNpmPackageRequestsForwardingLocked()
    {
        $this->selectField("npmPackageRequestsForwardingLocked");

        return $this;
    }

    public function selectNugetDuplicateExceptionRegex()
    {
        $this->selectField("nugetDuplicateExceptionRegex");

        return $this;
    }

    public function selectNugetDuplicatesAllowed()
    {
        $this->selectField("nugetDuplicatesAllowed");

        return $this;
    }

    public function selectNugetSymbolServerEnabled()
    {
        $this->selectField("nugetSymbolServerEnabled");

        return $this;
    }

    public function selectPypiPackageRequestsForwarding()
    {
        $this->selectField("pypiPackageRequestsForwarding");

        return $this;
    }

    public function selectPypiPackageRequestsForwardingLocked()
    {
        $this->selectField("pypiPackageRequestsForwardingLocked");

        return $this;
    }

    public function selectTerraformModuleDuplicateExceptionRegex()
    {
        $this->selectField("terraformModuleDuplicateExceptionRegex");

        return $this;
    }

    public function selectTerraformModuleDuplicatesAllowed()
    {
        $this->selectField("terraformModuleDuplicatesAllowed");

        return $this;
    }
}
