<?php

namespace GraphQL\SchemaObject;

class AwardEmojiQueryObject extends QueryObject
{
    const OBJECT_NAME = "AwardEmoji";

    public function selectDescription()
    {
        $this->selectField("description");

        return $this;
    }

    public function selectEmoji()
    {
        $this->selectField("emoji");

        return $this;
    }

    public function selectName()
    {
        $this->selectField("name");

        return $this;
    }

    public function selectUnicode()
    {
        $this->selectField("unicode");

        return $this;
    }

    public function selectUnicodeVersion()
    {
        $this->selectField("unicodeVersion");

        return $this;
    }

    public function selectUser(AwardEmojiUserArgumentsObject $argsObject = null)
    {
        $object = new UserCoreQueryObject("user");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
