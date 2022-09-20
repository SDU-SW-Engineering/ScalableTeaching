<?php

namespace Domain\SourceControl;

class User
{
    public function __construct(public string $id, public string $name)
    {
    }

    public static function token($user = 'default') : string
    {
        return config("sourcecontrol.users.$user.token");
    }
}
