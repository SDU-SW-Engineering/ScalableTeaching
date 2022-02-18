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
}
