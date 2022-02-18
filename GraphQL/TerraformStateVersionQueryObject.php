<?php

namespace GraphQL\SchemaObject;

class TerraformStateVersionQueryObject extends QueryObject
{
    const OBJECT_NAME = "TerraformStateVersion";

    public function selectCreatedAt()
    {
        $this->selectField("createdAt");

        return $this;
    }

    public function selectCreatedByUser(TerraformStateVersionCreatedByUserArgumentsObject $argsObject = null)
    {
        $object = new UserCoreQueryObject("createdByUser");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectDownloadPath()
    {
        $this->selectField("downloadPath");

        return $this;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectJob(TerraformStateVersionJobArgumentsObject $argsObject = null)
    {
        $object = new CiJobQueryObject("job");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSerial()
    {
        $this->selectField("serial");

        return $this;
    }

    public function selectUpdatedAt()
    {
        $this->selectField("updatedAt");

        return $this;
    }
}
