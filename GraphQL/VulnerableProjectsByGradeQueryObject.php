<?php

namespace GraphQL\SchemaObject;

class VulnerableProjectsByGradeQueryObject extends QueryObject
{
    const OBJECT_NAME = "VulnerableProjectsByGrade";

    public function selectCount()
    {
        $this->selectField("count");

        return $this;
    }

    public function selectGrade()
    {
        $this->selectField("grade");

        return $this;
    }

    public function selectProjects(VulnerableProjectsByGradeProjectsArgumentsObject $argsObject = null)
    {
        $object = new ProjectConnectionQueryObject("projects");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
