<?php

namespace GraphQL\SchemaObject;

class DastSiteProfileQueryObject extends QueryObject
{
    const OBJECT_NAME = "DastSiteProfile";

    public function selectAuth(DastSiteProfileAuthArgumentsObject $argsObject = null)
    {
        $object = new DastSiteProfileAuthQueryObject("auth");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectEditPath()
    {
        $this->selectField("editPath");

        return $this;
    }

    public function selectExcludedUrls()
    {
        $this->selectField("excludedUrls");

        return $this;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectNormalizedTargetUrl()
    {
        $this->selectField("normalizedTargetUrl");

        return $this;
    }

    public function selectProfileName()
    {
        $this->selectField("profileName");

        return $this;
    }

    public function selectReferencedInSecurityPolicies()
    {
        $this->selectField("referencedInSecurityPolicies");

        return $this;
    }

    public function selectRequestHeaders()
    {
        $this->selectField("requestHeaders");

        return $this;
    }

    public function selectTargetType()
    {
        $this->selectField("targetType");

        return $this;
    }

    public function selectTargetUrl()
    {
        $this->selectField("targetUrl");

        return $this;
    }

    public function selectUserPermissions(DastSiteProfileUserPermissionsArgumentsObject $argsObject = null)
    {
        $object = new DastSiteProfilePermissionsQueryObject("userPermissions");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectValidationStatus()
    {
        $this->selectField("validationStatus");

        return $this;
    }
}
